<?php

namespace App\Listeners;

use App\Events\RegistraInicioSesion;
use Firebase\FirebaseLib;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSesionFireBase implements ShouldQueue
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
	 * @param  RegistraInicioSesion $event
	 *
	 * @return void
	 */
	public function handle(RegistraInicioSesion $event)
	{
		$data = $event->data;
		
		$firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
		$tipo = ($data['ejecutivo']) ? 'ejecutivo' : 'contacto';
		$path = 'login/' . $tipo . '/' . date('dmY');
		
		$firebaseClient->push($path, $data['usuario']);
	}
}
