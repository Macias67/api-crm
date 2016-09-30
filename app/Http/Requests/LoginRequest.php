<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest as Request;

class LoginRequest extends Request
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
			'email'    => 'required|email|exists:usr_usuarios,email',
			'password' => 'required',
		];
	}
	
	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'email.exists' => 'El email no está registrado en la aplicación'
		];
	}
}