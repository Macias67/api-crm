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
		$dataBuilder->addData(['expiry_date' => date('d/m/Y', $notification->getTimestamp()), 'discount' => (rand(1, 10) / 10)]);
		
		$option = $optionBuiler->build();
		$notification = $notificationBuilder->build();
		$data = $dataBuilder->build();
		
		/**
		 * @TODO Sustituir por el user_id de la var notificacion
		 */
		$userNotif = UserApp::find(1); // Siempre a mi tel
		if ($userNotif->device_token)
		{
			FCM::sendTo($userNotif->device_token, $option, $notification, $data);
		}
	}
}
