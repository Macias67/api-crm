<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\LogInicioSesion;
use App\Events\NotificaUsuario;
use App\Events\RegistraInicioSesion;
use App\Events\UsuarioEntro;
use App\Http\Controllers\Controller;
use App\Http\Models\FBNotification;
use App\Http\Models\UserApp;
use App\Http\Requests\LoginRequest;
use App\Transformers\UserAppTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Auth extends Controller
{
	use Helpers;
	
	public function me(Request $request)
	{
		$token = JWTAuth::getToken();
		$user = JWTAuth::toUser($token);
		
		return $this->response->item($user, new UserAppTransformer());
	}
	
	public function authenticate(LoginRequest $request)
	{
		
		// grab credentials from the request
		$credentials = $request->only('email', 'password');
		try
		{
			// attempt to verify the credentials and create a token for the user
			if (!$token = JWTAuth::attempt($credentials))
			{
				throw new UnauthorizedHttpException(null, 'No se puede autenticar con este email  y contraseña.');
			}
			else
			{
				$usuario = UserApp::where($request->only(['email']))->first();
				$usuario->token = $token;
				
				$tipo = ($usuario->ejecutivo) ? 'El ejecutivo' : 'El contacto';
				
				$notificacion = new FBNotification($usuario->nombreCompleto() . ' acaba de entrar al sistema');
				$notificacion->setMensaje($tipo . ' ' . $usuario->nombreCompleto() . ' entro al sistema a las ' . date('h:i A', $notificacion->getTimestamp()))
				             ->setTipo(FBNotification::INFO);
				
				$agent = new Agent();
				
				$data = [
					'usuario'   => [
						'id'          => $request->user()->id,
						'nombre'      => $request->user()->nombreCompleto(),
						'ip'          => $request->ip(),
						'dispositivo' => ($agent->isDesktop()) ? 'pc' : 'móvil',
						'plataforma'  => $agent->platform(),
						'browser'     => $agent->browser(),
						'datetime'    => date('d-m-Y H:i:s')
					],
					'ejecutivo' => $request->user()->ejecutivo
				];
				
				event(new NotificaUsuario($notificacion));
				event(new RegistraInicioSesion($data));
				
				// all good so return the token
				return $this->response->item($usuario, new UserAppTransformer());
			}
		}
		catch (JWTException $e)
		{
			// something went wrong whilst attempting to encode the token
			throw new HttpException($e->getStatusCode(), $e->getMessage());
		}
	}
	
	/**
	 * @TODO Funcion de prueba para actualizar token del dispositivo
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function tokenRefresh(Request $request)
	{
		$user = UserApp::find(1);
		$user->device_token = $request->get('token');
		$user->save();
		
		return $this->response->noContent();
	}
}
