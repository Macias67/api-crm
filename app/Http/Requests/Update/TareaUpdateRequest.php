<?php

namespace App\Http\Requests\Update;

use Dingo\Api\Http\FormRequest as Request;

class TareaUpdateRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @TODO validar que el usuario actual es el asginado de la tarea
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
			'fechainicio'   => 'date|date_format:Y-m-d H:i:s',
			'duracionminutos'      => 'integer',
			'fechatentativacierre' => 'date|date_format:Y-m-d H:i:s',
		];
	}
}
