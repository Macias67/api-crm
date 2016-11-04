<?php

namespace App\Http\Requests;

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
		switch ($this->getMethod())
		{
			case 'GET':
			{
				return [];
			}
			case 'DELETE':
			{
				return [];
			}
			case 'POST':
			{
				$rules = [
					'descripcion' => 'required',
					'tipo'        => 'required|boolean',
					'avance'      => 'required|integer',
					'habilitado'  => 'boolean'
				];
				
				if ($this->has('archivo'))
				{
					$rules_archivo = [
						'archivo.url'         => 'required|url',
						'archivo.contentType' => 'required',
						'archivo.fullPath'    => 'required',
						'archivo.hash'        => 'required',
						'archivo.name'        => 'required',
						'archivo.size'        => 'required|integer',
					];
					
					$rules = array_merge($rules, $rules_archivo);
				}
				
				return $rules;
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'nota'    => 'required',
					'publico' => 'required|boolean',
					'avance'  => 'required|integer'
				];
			}
			default:
				break;
		}
	}
}
