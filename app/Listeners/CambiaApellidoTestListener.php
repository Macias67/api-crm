<?php

namespace App\Listeners;

use App\Events\TestEvent;

class CambiaApellidoTestListener
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
	 * @param  TestEvent $event
	 *
	 * @return void
	 */
	public function handle(TestEvent $event)
	{
		$event->usuario->apellido = 'Cambiado desde evento';
		$event->usuario->save();
	}
}
