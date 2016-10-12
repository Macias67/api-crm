<?php
/**
 * User: Luis
 * Date: 15/08/2016
 * Time: 08:24 AM
 */

namespace App\Transformers;

use App\Http\Models\CasoLider;
use League\Fractal\TransformerAbstract;

class CasoLiderTransformer extends TransformerAbstract
{
	public function transform(CasoLider $casoLider)
	{
		$data = [
			'nombre'      => $casoLider->lider->usuario->nombreCompleto(),
			'fecha'       => $casoLider->created_at->getTimestamp()
		];
		
		return $data;
	}
}