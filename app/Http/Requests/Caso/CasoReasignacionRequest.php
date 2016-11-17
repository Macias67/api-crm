<?php

namespace App\Http\Requests\Caso;

use App\Http\Models\Caso;
use Dingo\Api\Http\FormRequest as Request;
use Illuminate\Support\Facades\Hash;

class CasoReasignacionRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$idCaso = $this->segment(3);
		$caso = Caso::find($idCaso);
		
		$idUser = $this->user()->id;
		$password = $this->password;
		
		$lider = $caso->casoLider->lider->usuario;
		
		return (($idUser == $lider->id) && Hash::check($password, $lider->password));
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'estatus'  => 'required|integer|exists:cs_caso_estatus,id',
			'password' => 'required'
		];
	}
}
