<?php

namespace App\Listeners;

use App\Events\UsuarioEntro;
use App\Http\Models\UserApp;
use Illuminate\Contracts\Queue\ShouldQueue;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class EnviaNotificacion implements ShouldQueue
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
	 * @param  UsuarioEntro $event
	 *
	 * @return void
	 */
	public function handle(UsuarioEntro $event)
	{
		$usuario = $event->usuario;
		
		$optionBuiler = new OptionsBuilder();
		$optionBuiler->setTimeToLive(60 * 20);
		
		$notificationBuilder = new PayloadNotificationBuilder($usuario->nombreCompleto() . ' ha entrado al sistema');
		$notificationBuilder->setBody('El usuario ' . $usuario->nombreCompleto() . ' ha entrado al sistema.')
		                    ->setSound('default');
		
		$dataBuilder = new PayloadDataBuilder();
		$dataBuilder->addData(['expiry_date' => date('d/m/Y', time() + 60 * 60 * 24 * rand(1, 60)), 'discount' => (rand(1, 10) / 10)]);
		
		$option = $optionBuiler->build();
		$notification = $notificationBuilder->build();
		$data = $dataBuilder->build();
		
		$userNotif = UserApp::find(1); // Siempre mi tel
		FCM::sendTo($userNotif->device_token, $option, $notification, $data);
	}
}
