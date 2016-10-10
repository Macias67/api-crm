<?php

namespace App\Listeners;

use App\Events\NotificaUsuario;
use Firebase\FirebaseLib;
use Illuminate\Contracts\Queue\ShouldQueue;

class PushNotificacionFirebase implements ShouldQueue
{
	private $PATH_NOTIFICATION = '/notificaciones';
	
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
		$firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
		$firebaseClient->push($this->PATH_NOTIFICATION, $notification->toArray());
	}
}
