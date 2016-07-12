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
			'id_unidad'   => 'required|integer|exists:ec_unidad_productos,id',
			'codigo'   => 'required|max:20|unique:ec_productos,codigo',
			'producto' => 'required|max:100|unique:ec_productos,producto',
			'descripcion' => 'required',
			'precio'   => 'required|max:45',
			'online'   => 'boolean'
		];
	}
}
