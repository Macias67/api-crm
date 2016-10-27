<?php

namespace App\Listeners;

use App\Events\NotificaUsuario;
use App\Http\Models\UserApp;
use Illuminate\Contracts\Queue\ShouldQueue;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class SendPushNotification implements ShouldQueue
{
	/**
	 * Create the event listener.
	 *
	 */
	public function __construct()
	{
		//
	}
	
	/**
	 * Handle the event.
	 *
	 * @param  NotificaUsuario $event
	 *
	 * @return void
	 */
	public function handle(NotificaUsuario $event)
	{
		$notification = $event->notificacion;
		
		$optionBuiler = new OptionsBuilder();
		$optionBuiler->setTimeToLive(60 * 20);
		
		$notificationBuilder = new PayloadNotificationBuilder($notification->getTitulo());
		$notificationBuilder->setBody($notification->getMensaje())
		                    ->setSound('default');
		
		$dataBuilder = new PayloadDataBuilder();
		$dataBuilder->addData([
			'expiry_date' => date('d/m/Y', $notification->getTimestamp()),
			'discount'    => (rand(1, 10) / 10),
			'tipo'        => $notification->getTipo()
		]);
		
		$option = $optionBuiler->build();
		$notification = $notificationBuilder->build();
		$data = $dataBuilder->build();
		
		/**
		 * @TODO Sustituir por el user_id de la var notificacion
		 */
		$user = UserApp::find(1); // Siempre a mi
		$tokens = $user->deviceTokens()->pluck('token');
		
		if (!$tokens->isEmpty())
		{
			//@TODO Tener un log de notificaciones exitosas
			$downstreamResponse = FCM::sendTo($tokens->toArray(), $option, $notification, $data);
		}
	}
}
