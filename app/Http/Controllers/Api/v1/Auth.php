<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Ejecutivo;
use App\Http\Requests;
use App\Transformers\EjecutivoTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
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
		
		return $this->response->item($user, new EjecutivoTransformer());
	}
	
	public function authenticate(Request $request)
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
				$ejecutivo = Ejecutivo::where($request->only(['email']))->first();
				$ejecutivo->token = $token;
			}
		}
		catch (JWTException $e)
		{
			// something went wrong whilst attempting to encode the token
			throw new HttpException($e->getStatusCode(), $e->getMessage());
		}

		//return response()->json(array('token' => $ejecutivo->token));
		
		// all good so return the token
		return $this->response->item($ejecutivo, new EjecutivoTransformer());
	}
}
