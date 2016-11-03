<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest as Request;

class TareaAgendaRequest extends Request
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
		switch ($this->getMethod())
		{
			case 'GET':
			{
				return [];
			}
			case 'DELETE':
			{
				return [
					'id' => 'required|integer|exists:cs_tarea_agenda,id',
				];
			}
			case 'POST':
			{
				return [
					'start'            => 'required|date|date_format:Y-m-d H:i:s',
					'end'              => 'required|date|date_format:Y-m-d H:i:s',
					'duracionSegundos' => 'required|integer'
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [];
			}
			default:
				break;
		}
	}
}
