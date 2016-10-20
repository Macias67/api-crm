<?php
/**
 * User: Luis Macias
 * Date: 20/10/2016
 * Time: 06:13 PM
 */

namespace App\Transformers;

use App\Http\Models\Agenda;
use League\Fractal\TransformerAbstract;

class EjecutivoAgendaTransformer extends TransformerAbstract
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
			'creado'      => $agenda->created_at->getTimestamp(),
		];
		
		return $data;
	}
}