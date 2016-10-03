<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\TestEvent;
use App\Events\UsuarioEntro;
use App\Http\Controllers\Controller;
use App\Http\Models\UserApp;
use App\Http\Requests\LoginRequest;
use App\Transformers\UserAppTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
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
				
				event(new UsuarioEntro($usuario));
				
				$usuario->token = $token;
				
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
