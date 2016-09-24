<?php

namespace App\Http\Requests\Create;

use Dingo\Api\Http\FormRequest as Request;

class NotaRequest extends Request
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
			'descripcion'       => 'required',
			'tipo'    => 'required|boolean',
			'habilitado' => 'boolean',
		];
	}
}
