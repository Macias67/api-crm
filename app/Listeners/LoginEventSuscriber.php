<?php
/**
 * User: Luis Macias
 * Date: 27/10/2016
 * Time: 02:38 PM
 */

namespace App\Listeners;

use App\Http\Models\FBNotification;
use Firebase\FirebaseLib;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;

class LoginEventSuscriber
{
	use SendPushNotification;
	
	/**
	 * Handle user login events.
	 *
	 * @param \App\Events\LoginUserEvent $event
	 */
	public function onUserLogin($event)
	{
		$usuario = $event->user;
		
		$tipo = ($usuario->ejecutivo) ? 'El ejecutivo' : 'El contacto';
		
		$notificacion = new FBNotification();
		
		$notificacion->getPayloadNotificationBuilder()
		             ->setTitle($tipo . ' ' . $usuario->nombreCompleto() . ' ha entrado al sistema.')
		             ->setBody($tipo . ' ' . $usuario->nombreCompleto() . ' entró al sistema a las ' . date('h:i A') . '.')
		             ->setSound('default');
		
		$notificacion->getPayloadDataBuilder()->addData([
			'expiry_date' => date('d/m/Y'),
			'discount'    => (rand(1, 10) / 10),
			'tipo'        => FBNotification::INFO
		]);
		$notificacion->getOptionsBuilder()->setTimeToLive(60 * 20);
		
		
		$this->sendPushNotification($notificacion);
		$this->logLoginUser($usuario);
	}
	
	/**
	 * Registro de inicio de sesion.
	 *
	 * @param param \App\Http\Models\UserApp $usuario
	 */
	private function logLoginUser($usuario)
	{
		$firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
		
		$tipo = ($usuario->ejecutivo) ? 'ejecutivo' : 'contacto';
		$path = 'login/' . $tipo . '/' . date('dmY');
		
		$agent = new Agent();
		
		$data = [
			'id'          => $usuario->id,
			'nombre'      => $usuario->nombreCompleto(),
			'ip'          => Request::ip(),
			'dispositivo' => ($agent->isDesktop()) ? 'pc' : 'móvil',
			'plataforma'  => $agent->platform(),
			'browser'     => $agent->browser(),
			'datetime'    => date('d-m-Y H:i:s')
		];
		
		$firebaseClient->push($path, $data);
	}
	
	/**
	 * Envio de correo de prueba
	 *
	 * @param $event
	 */
	public function sendEmailTest($event)
	{
		$usuario = $event->user;
		Mail::send('email.test', ['nombre' => $usuario->nombreCompleto()], function ($m) use ($usuario)
		{
			$m->from('hello@app.com', 'Your Application');
			
			$m->to($usuario->email, $usuario->nombreCompleto())->subject('Envío de correo desde Laravel.');
		});
		
	}
	
	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param   \Illuminate\Events\Dispatcher $events
	 */
	public function subscribe($events)
	{
		$events->listen(
			'App\Events\LoginUserEvent',
			'App\Listeners\LoginEventSuscriber@onUserLogin'
		);
		
		$events->listen(
			'App\Events\LoginUserEvent',
			'App\Listeners\LoginEventSuscriber@sendEmailTest'
		);
	}
}