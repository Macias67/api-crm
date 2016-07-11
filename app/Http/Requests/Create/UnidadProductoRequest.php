<?php

namespace App\Http\Requests\Create;

use Dingo\Api\Http\FormRequest as Request;

class UnidadProductoRequest extends Request
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
			'unidad' => 'required|max:45|unique:ec_unidad_productos,unidad',
		        'plural' => 'required|max:45|unique:ec_unidad_productos,plural',
			'abreviatura' => 'required|max:45|unique:ec_unidad_productos,abreviatura'
		];
	}
}
