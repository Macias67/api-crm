<?php

namespace App\Http\Requests\Create;

use Dingo\Api\Http\FormRequest as Request;

class ProductoRequest extends Request
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
			'unidad'      => 'required',
			'codigo'      => 'required|max:20|unique:ec_unidad_productos,plural',
			'producto' => 'required|max:45|unique:ec_unidad_productos,abreviatura'
		];
	}
}
