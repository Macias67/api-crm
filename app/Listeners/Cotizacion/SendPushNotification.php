<?php

namespace App\Listeners\Cotizacion;

use App\Events\CotizacionEvent;
use App\Http\Models\FBNotification;
use App\Http\Models\UserApp;
use Illuminate\Contracts\Queue\ShouldQueue;
use LaravelFCM\Facades\FCM;

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
	 * @param  CotizacionEvent $event
	 *
	 * @return void
	 */
	public function handle(CotizacionEvent $event)
	{
		$cotizacion = $event->cotizacion;
		
		$notificacion = new FBNotification();
		
		$notificacion->getPayloadNotificationBuilder()
		             ->setTitle('Nueva cotización por pagar.')
		             ->setBody('Se ha enviado una nueva cotización por pagar a nombre de ' . $cotizacion->contacto->usuario->nombreCompleto() . '.')
		             ->setSound('default');
		
		$notificacion->getPayloadDataBuilder()->addData([
			'expiry_date' => date('d/m/Y'),
			'discount'    => (rand(1, 10) / 10),
			'vencimiento' => $cotizacion->vencimiento,
			'total'       => $cotizacion->total,
			'tipo'        => FBNotification::INFO
		]);
		$notificacion->getOptionsBuilder()->setTimeToLive(60 * 20);
		
		$option = $notificacion->getOptionsBuilder()->build();
		$notification = $notificacion->getPayloadNotificationBuilder()->build();
		$data = $notificacion->getPayloadDataBuilder()->build();
		
		/**
		 * @TODO La cotización se le notificará a todos los contactos de la empresa.
		 */
//		$contactos = $cotizacion->cliente->contactos;
//
//		foreach ($contactos as $contacto)
//		{
//			$tokens = $contacto->usuario->deviceTokens()->pluck('token');
//
//			if (!$tokens->isEmpty())
//			{
//				$downstreamResponse = FCM::sendTo($tokens->toArray(), $option, $notification, $data);
//			}
//		}
		
		$user = UserApp::find(1); // Siempre a mi
		$tokens = $user->deviceTokens()->pluck('token');
		
		if (!$tokens->isEmpty())
		{
			//@TODO Tener un log de notificaciones exitosas
			$downstreamResponse = FCM::sendTo($tokens->toArray(), $option, $notification, $data);
		}
	}
}
