<?php

namespace App\Http\Requests\Update;

use App\Http\Requests\Request;

class TokenUpdateRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'id'         => 'required|integer|exists:usr_usuario_tokens,id',
			'id_usuario' => 'required|integer|exists:usr_usuarios,id',
			'token'      => 'required|string',
		];
	}
}
