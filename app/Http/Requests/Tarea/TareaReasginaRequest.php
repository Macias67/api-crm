<?php

namespace App\Http\Requests\Tarea;

use App\Http\Models\Tarea;
use Dingo\Api\Http\FormRequest as Request;

class TareaReasginaRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$idTarea = $this->segment(3);
		$tarea = Tarea::find($idTarea);
		$idUser = $this->user()->id;
		$lider = $tarea->caso->casoLider->lider->id;
		$ejecutivoTarea = $tarea->ejecutivo->id;
		
		return ($idUser == $lider || $idUser == $ejecutivoTarea);
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'ejecutivo' => 'required|integer|exists:ec_ejecutivos,id',
			'motivo'    => 'required',
		];
	}
}
