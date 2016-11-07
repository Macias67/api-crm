<?php

namespace App\Http\Requests;

use App\Http\Models\Tarea;
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
	public
	function rules()
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
					'ejecutivo'   => 'required|integer|exists:ec_ejecutivos,id',
					'titulo'      => 'required',
					'descripcion' => 'required'
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'caso'                        => 'required|integer|exists:cs_caso,id',
					'estatus'                     => 'required|integer|exists:cs_tarea_estatus,id',
					'titulo'                      => 'required|max:140',
					'descripcion'                 => 'required',
					'avance'                      => 'integer|min:0|max:100',
					'fecha_inicio'                => 'date|date_format:Y-m-d H:i:s',
					'fecha_tentativa_cierre'      => 'date|date_format:Y-m-d H:i:s',
					'fecha_cierre'                => 'date|date_format:Y-m-d H:i:s',
					'duracion_tentativa_segundos' => 'integer',
					'duracion_real_segundos'      => 'integer',
					'activo'                      => 'boolean',
				];
			}
			default:
				break;
		}
	}
}
