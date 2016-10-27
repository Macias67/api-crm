<?php
/**
 * User: Luis Macias
 * Date: 27/10/2016
 * Time: 03:37 PM
 */

namespace App\Listeners;

use App\Http\Models\UserApp;
use LaravelFCM\Facades\FCM;

trait SendPushNotification
{
	/**
	 * @param \App\Http\Models\FBNotification $fbNotification
	 */
	private function sendPushNotification($fbNotification)
	{
		$option = $fbNotification->getOptionsBuilder()->build();
		$notification = $fbNotification->getPayloadNotificationBuilder()->build();
		$data = $fbNotification->getPayloadDataBuilder()->build();
		
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