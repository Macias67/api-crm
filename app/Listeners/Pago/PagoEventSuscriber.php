<?php
/**
 * User: Luis Macias
 * Date: 27/10/2016
 * Time: 10:11 PM
 */

namespace App\Listeners\Pago;

use App\Http\Models\FBNotification;
use App\Http\Models\UserApp;
use LaravelFCM\Facades\FCM;

class PagoEventSuscriber
{
	/**
	 * Notificación que se le hará llegar al departamento de Bancos.
	 *
	 * @param \App\Events\Pago\PagoSubido $event
	 */
	public function onSubidaSendPushNotification($event)
	{
		$pago = $event->pago;
		
		$notificacion = new FBNotification();
		
		$notificacion->getPayloadNotificationBuilder()
		             ->setTitle('Nuevo pago por validar de ' . $pago->cotizacion->cliente->razonsocial . '.')
		             ->setBody('El contacto ' . $pago->contacto->usuario->nombreCompleto() . ' de la empresa ' . $pago->cotizacion->cliente->razonsocial . ' ha subido un nuevo pago para validar.')
		             ->setSound('default');
		
		$notificacion->getPayloadDataBuilder()->addData([
			'expiry_date' => date('d/m/Y'),
			'discount'    => (rand(1, 10) / 10),
			'tipo'        => FBNotification::INFO
		]);
		$notificacion->getOptionsBuilder()->setTimeToLive(60 * 20);
		
		$option = $notificacion->getOptionsBuilder()->build();
		$notification = $notificacion->getPayloadNotificationBuilder()->build();
		$data = $notificacion->getPayloadDataBuilder()->build();
		
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
	
	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param   \Illuminate\Events\Dispatcher $events
	 */
	public function subscribe($events)
	{
		$events->listen(
			'App\Events\Pago\PagoSubido',
			'App\Listeners\Pago\PagoEventSuscriber@onSubidaSendPushNotification'
		);
	}
}