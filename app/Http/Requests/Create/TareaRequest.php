<?php

namespace App\Http\Requests\Create;

use Dingo\Api\Http\FormRequest as Request;

class TareaRequest extends Request
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
			'ejecutivo'   => 'required|integer|exists:ec_ejecutivos,ejecutivo_id',
			'titulo'      => 'required',
			'descripcion' => 'required'
		];
	}
}
