<?php
/**
 * User: Luis Macias
 * Date: 19/10/2016
 * Time: 04:39 PM
 */

namespace App\Transformers;

use App\Http\Models\Agenda;
use League\Fractal\TransformerAbstract;

class AgendaTransformer extends TransformerAbstract
{
	public function transform(Agenda $agenda)
	{
		$data = [
			'id'          => $agenda->id,
			'ejecutivo'   => [
				'id'     => $agenda->ejecutivo->id,
				'nombre' => $agenda->ejecutivo->usuario->nombreCompleto(),
				'color'  => $agenda->ejecutivo->color,
				'class'  => $agenda->ejecutivo->class,
			],
			'titulo'      => $agenda->titulo,
			'descripcion' => $agenda->descripcion,
			'allDay'      => $agenda->allDay,
			'start'       => $agenda->start->getTimestamp(),
			'end'         => $agenda->end->getTimestamp(),
			'url'         => $agenda->url,
			'referencia'  => $agenda->referencia,
			'notificado'  => $agenda->notificado,
			'creado'      => $agenda->created_at->getTimestamp(),
		];
		
		return $data;
	}
}