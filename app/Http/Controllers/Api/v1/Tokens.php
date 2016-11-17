<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\UsuarioTokens;
use App\Http\Requests\Token\TokenRequest;
use App\Transformers\Token\TokenTransformer;
use Dingo\Api\Routing\Helpers;

class Tokens extends Controller
{
	use Helpers;
	
	/**
	 * Guarda los FCM tokens de los usarios.
	 *
	 * @param \App\Http\Requests\Token\TokenRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(TokenRequest $request)
	{
		$token = $request->fcm;
		
		$usuarioToken = UsuarioTokens::where('token', $token)->get()->first();
		
		if (is_null($usuarioToken))
		{
			$usuarioToken = UsuarioTokens::create([
				'id_usuario' => $request->user()->id,
				'token'      => $token
			]);
		}
		
		return $this->response->item($usuarioToken, new TokenTransformer());
	}
}
