<?php

namespace App\Http\Requests\Create;

use Dingo\Api\Http\FormRequest as Request;

class AgendaRequest extends Request
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
			'ejecutivo'   => 'required|integer|exists:ec_ejecutivos,id',
			'titulo'      => 'required|max:140',
			'descripcion' => 'required|max:140',
			'allday'      => 'boolean',
			'start'       => 'required|date|date_format:Y-m-d H:i:s',
			'end'         => 'required|date|date_format:Y-m-d H:i:s',
			'url'         => 'url',
			'referencia'  => '',
		];
	}
}
