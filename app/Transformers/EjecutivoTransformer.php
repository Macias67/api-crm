<?php
/**
 * User: Luis
 * Date: 22/05/2016
 * Time: 12:36 PM
 */

namespace App\Transformers;

use App\Http\Models\Ejecutivo;
use League\Fractal\TransformerAbstract;

class EjecutivoTransformer extends TransformerAbstract
{
	public function transform(Ejecutivo $ejecutivo)
	{
		$oficina = $ejecutivo->oficina;
		$data = [
			'id'           => $ejecutivo->id,
			'nombre'       => $ejecutivo->nombre,
			'apellido'     => $ejecutivo->apellido,
			'email'        => $ejecutivo->email,
			'avatar'       => $ejecutivo->avatar,
			'oficina'      => [
				'calle'     => $oficina->calle,
				'numero'    => $oficina->numero,
				'colonia'   => $oficina->colonia,
				'cp'        => $oficina->cp,
				'ciudad'    => $oficina->ciudad,
				'estado'    => $oficina->estado,
				'latitud'   => $oficina->latitud,
				'longitud'  => $oficina->longitud,
				'telefonos' => explode(',', $oficina->telefonos),
				'email'     => $oficina->email,
			],
			'departamento' => $ejecutivo->departamento,
			'created_at'   => $ejecutivo->created_at,
			'updated_at'   => $ejecutivo->updated_at
		];
		
		if (isset($ejecutivo->token))
		{
			$data['token'] = $ejecutivo->token;
		}
		
		return $data;
	}
}