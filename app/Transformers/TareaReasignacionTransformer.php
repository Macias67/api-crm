<?php
/**
 * User: Luis
 * Date: 06/11/2016
 * Time: 01:24 PM
 */

namespace App\Transformers;

use App\Http\Models\TareaReasignacion;
use League\Fractal\TransformerAbstract;

class TareaReasignacionTransformer extends TransformerAbstract
{
	public function transform(TareaReasignacion $reasignacion)
	{
		return [
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
	}
}