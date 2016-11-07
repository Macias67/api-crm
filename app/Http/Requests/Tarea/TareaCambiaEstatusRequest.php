<?php
/**
 * User: Luis
 * Date: 06/11/2016
 * Time: 05:42 PM
 */

namespace App\Http\Requests\Tarea;

use App\Http\Models\Tarea;
use Dingo\Api\Http\FormRequest as Request;
use Illuminate\Support\Facades\Hash;

class TareaCambiaEstatusRequest extends Request
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
		$password = $this->password;
		
		$lider = $tarea->caso->casoLider->lider->usuario;
		$ejecutivoTarea = $tarea->ejecutivo->usuario;
		
		return ($idUser == $lider->id || $idUser == $ejecutivoTarea->id) && (Hash::check($password, $lider->password) || Hash::check($password, $ejecutivoTarea->password));
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'estatus'  => 'required|integer|exists:cs_tarea_estatus,id',
			'password' => 'required'
		];
	}
}