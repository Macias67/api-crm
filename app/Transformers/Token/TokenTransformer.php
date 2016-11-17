<?php
/**
 * User: Luis
 * Date: 28/10/2016
 * Time: 02:26 PM
 */

namespace App\Transformers\Token;

use App\Http\Models\UsuarioTokens;
use League\Fractal\TransformerAbstract;

class TokenTransformer extends TransformerAbstract
{
	public function transform(UsuarioTokens $usuarioToken)
	{
		$data = [
		        'fcm' => $usuarioToken->token
		];
		
		return $data;
	}
}