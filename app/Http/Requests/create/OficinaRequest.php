<?php

namespace App\Http\Requests\Create;

use Dingo\Api\Http\FormRequest as Request;

class OficinaRequest extends Request
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

		$rules = [
			'calle'     => 'max:45',
			'numero'    => 'max:45',
			'colonia'   => 'max:45',
			'cp'        => 'max:6',
			'ciudad'    => 'max:45',
			'estado'    => 'max:45',
			'latitud'   => 'max:150',
			'longitud'  => 'max:150',
			'telefonos' => 'max:200',
			'email'     => 'email|max:60|unique:ec_oficinas,email',
			'online'    => 'in:0,1'
		];
		
		if ($this->getMethod() === "POST")
		{
			$rules = [
				'calle'     => 'required|max:45',
				'numero'    => 'required|max:45',
				'colonia'   => 'required|max:45',
				'cp'        => 'required|max:6',
				'ciudad'    => 'required|max:45',
				'estado'    => 'required|max:45',
				'latitud'   => 'required|max:150',
				'longitud'  => 'required|max:150',
				'telefonos' => 'required|max:200',
				'email'     => 'required|email|max:60|unique:ec_oficinas,email'
			];
		}

		return $rules;
	}
}
