<?php
/**
 * User: Luis Macias
 * Date: 08/06/2016
 * Time: 08:03 PM
 */

namespace App\Transformers;


use App\Http\Models\Oficinas;
use League\Fractal\TransformerAbstract;

class OficinaTransformer extends TransformerAbstract
{
	public function transform(Oficinas $oficina)
	{
		$data = [
			'id'         => $oficina->id,
			'calle'      => $oficina->calle,
			'numero'     => $oficina->numero,
			'colonia'    => $oficina->colonia,
			'cp'         => $oficina->cp,
			'ciudad'     => $oficina->ciudad,
			'estado'     => $oficina->estado,
			'latitud'    => (float)$oficina->latitud,
			'longitud'   => (float)$oficina->longitud,
			'telefonos'  => explode(',', $oficina->telefonos),
			'email'      => $oficina->email,
			'created_at' => $oficina->created_at,
			'updated_at' => $oficina->updated_at
		];
		
		return $data;
	}
}