<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * The event listener mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'App\Events\NotificaUsuario' => [
			'App\Listeners\SendPushNotification',
			//'App\Listeners\PushNotificacionFirebase',
		],
		'App\Events\RegistraInicioSesion' => [
			'App\Listeners\LogSesionFireBase'
		]
	];
	
	/**
	 * The subscriber classes to register.
	 *
	 * @var array
	 */
	protected $subscribe = [
	];
	
	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher $events
	 *
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);
		
		//
	}
}
