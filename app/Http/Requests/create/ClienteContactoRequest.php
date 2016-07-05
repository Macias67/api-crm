<?php

namespace App\Http\Requests\create;

use Dingo\Api\Http\FormRequest as Request;

class ClienteContactoRequest extends Request
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
			'nombre'   => 'required|max:45',
			'apellido' => 'required|max:45',
			'email'    => 'required|email|max:60|unique:cl_contactos,email'
		];
	}
}
