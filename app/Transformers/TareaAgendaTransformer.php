<?php
/**
 * User: Luis
 * Date: 02/11/2016
 * Time: 08:56 PM
 */

namespace App\Transformers;

use App\Http\Models\TareaAgenda;
use League\Fractal\TransformerAbstract;

class TareaAgendaTransformer extends TransformerAbstract
{
	public function transform(TareaAgenda $agenda)
	{
		$data = [
			'id'         => $agenda->id,
			'ejecutivo'  => [
				'id'     => $agenda->tarea->ejecutivo->id,
				'nombre' => $agenda->tarea->ejecutivo->usuario->nombreCompleto(),
				'color'  => $agenda->tarea->ejecutivo->color,
				'class'  => $agenda->tarea->ejecutivo->class,
			],
			'tarea' => [
				 'id'     => $agenda->tarea->id,
				 'titulo'                      => $agenda->tarea->titulo,
				 'descripcion'                 => $agenda->tarea->descripcion,
				 'avance'                      => $agenda->tarea->avance,
			],
			'caso'                        => [
				'id'      => $agenda->tarea->caso->id,
				'avance'  => $agenda->tarea->caso->avance,
				'cliente' => [
					'id'          => $agenda->tarea->caso->cliente->id,
					'razonsocial' => $agenda->tarea->caso->cliente->razonsocial,
					'rfc'         => $agenda->tarea->caso->cliente->rfc,
				],
				'lider'   => [
					'id'     => $agenda->tarea->caso->casoLider->lider->id,
					'nombre' => $agenda->tarea->caso->casoLider->lider->usuario->nombreCompleto(),
				],
				'estatus' => [
					'id'      => $agenda->tarea->caso->estatus->id,
					'estatus' => $agenda->tarea->caso->estatus->estatus,
					'class'   => $agenda->tarea->caso->estatus->class,
					'color'   => $agenda->tarea->caso->estatus->color
				]
			],
			'start'      => $agenda->start->getTimestamp(),
			'end'        => $agenda->end->getTimestamp(),
			'notificado' => $agenda->notificado,
			'creado'     => $agenda->created_at->getTimestamp(),
		];
		
		return $data;
	}
}