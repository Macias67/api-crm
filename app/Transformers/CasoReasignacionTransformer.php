<?php
/**
 * User: Luis
 * Date: 07/11/2016
 * Time: 10:09 PM
 */

namespace App\Transformers;

use App\Http\Models\CasoReasignacionLider;
use League\Fractal\TransformerAbstract;

class CasoReasignacionTransformer extends TransformerAbstract
{
	public function transform(CasoReasignacionLider $reasignacion)
	{
		$data = [
			'id'       => $reasignacion->id,
			'anterior' => [
				'id'     => $reasignacion->anterior->id,
				'nombre' => $reasignacion->anterior->usuario->nombreCompleto()
			],
			'actual'   => [
				'id'     => $reasignacion->actual->id,
				'nombre' => $reasignacion->actual->usuario->nombreCompleto()
			],
			'motivo'   => $reasignacion->motivo,
			'fecha'    => $reasignacion->created_at->getTimestamp()
		];
		
		return $data;
	}
}