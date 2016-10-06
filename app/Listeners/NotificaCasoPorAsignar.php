<?php

namespace App\Listeners;

use App\Events\CasoPorAsignar;
use App\Http\Models\UserApp;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class NotificaCasoPorAsignar
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
	 * @param  CasoPorAsignar $event
	 *
	 * @return void
	 */
	public function handle(CasoPorAsignar $event)
	{
		$cliente = $event->cliente;
		
		$optionBuiler = new OptionsBuilder();
		$optionBuiler->setTimeToLive(60 * 20);
		
		$notificationBuilder = new PayloadNotificationBuilder('Nuevo caso en espera de asignación.');
		$notificationBuilder->setBody('Nuevo caso del cliente ' . $cliente->razonsocial . ' esta en espera de asignación de líder.')
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
