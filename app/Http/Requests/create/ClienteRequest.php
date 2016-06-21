<?php

namespace App\Http\Requests\create;

use Dingo\Api\Http\FormRequest as Request;

class ClienteRequest extends Request
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
			'razonsocial' => 'required|max:100|unique:cl_clientes,razonsocial',
			'rfc'         => 'required|max:13|unique:cl_clientes,rfc',
			'email'       => 'required|email|max:60|unique:cl_clientes,email',
			'tipo'        => 'required|in:normal,distribuidor',
			'calle'       => 'required|max:45',
			'telefono'    => 'required|max:14',
			'telefono2'   => 'max:14',
			'noexterior'  => 'required|max:45',
			'nointerior'  => 'max:45',
			'colonia'     => 'required|max:45',
			'cp'          => 'required|max:6',
			'ciudad'      => 'required|max:45',
			'municipio'   => 'max:45',
			'estado'      => 'required|max:45',
			'pais'        => 'required|max:45'
		];
	}
}
