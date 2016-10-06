<?php

namespace App\Listeners;

use App\Events\ContactoSubePago;
use App\Http\Models\UserApp;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class NotificaSubidaPago
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}
	
	/**
	 * Handle the event.
	 *
	 * @param  ContactoSubePago $event
	 *
	 * @return void
	 */
	public function handle(ContactoSubePago $event)
	{
		$contacto = $event->contacto;
		
		$optionBuiler = new OptionsBuilder();
		$optionBuiler->setTimeToLive(60 * 20);
		
		$notificationBuilder = new PayloadNotificationBuilder('Nuevo pago subido para validar.');
		$notificationBuilder->setBody('El contacto ' . $contacto->usuario->nombreCompleto() . ' de la empresa ' . $contacto->cliente->razonsocial . ' ha subido un nuevo pago para validar.')
		                    ->setSound('default');
		
		$dataBuilder = new PayloadDataBuilder();
		$dataBuilder->addData(['expiry_date' => date('d/m/Y', time() + 60 * 60 * 24 * rand(1, 60)), 'discount' => (rand(1, 10) / 10)]);
		
		$option = $optionBuiler->build();
		$notification = $notificationBuilder->build();
		$data = $dataBuilder->build();
		
		$userNotif = UserApp::find(1); // Siempre a mi tel
		if ($userNotif->device_token)
		{
			FCM::sendTo($userNotif->device_token, $option, $notification, $data);
		}
	}
}
