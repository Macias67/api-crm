<?php
/**
 * User: Luis
 * Date: 10/07/2016
 * Time: 02:00 PM
 */

namespace App\Transformers;

use App\Http\Models\UnidadesProductos;
use League\Fractal\TransformerAbstract;

class UnidadTransformer extends TransformerAbstract
{
	public function transform(UnidadesProductos $unidad)
	{
		$data = [
			'id'     => $unidad->id,
			'unidad' => $unidad->unidad,
			'plural' => $unidad->plural,
			'abreviatura' => $unidad->abreviatura,
			'online' => $unidad->online,
		];
		
		return $data;
	}
}