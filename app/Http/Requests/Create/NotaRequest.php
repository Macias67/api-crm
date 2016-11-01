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
		$rules = [
			'descripcion' => 'required',
			'tipo'        => 'required|boolean',
			'avance'      => 'required|integer',
			'habilitado'  => 'boolean'
		];
		
		if ($this->has('archivo'))
		{
			$rules_archivo = [
				'archivo.url'         => 'required|active_url',
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
}
