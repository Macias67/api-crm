<?php
/**
 * User: Luis Macias
 * Date: 12/09/2016
 * Time: 09:19 PM
 */

namespace App\Transformers;

use App\Http\Models\Tarea;
use League\Fractal\TransformerAbstract;

class TareaTransformer extends TransformerAbstract
{
	public function transform(Tarea $tarea)
	{
		$notas_publicos = [];
		$notas_privados = [];
		$todas = [];
		
		$notas = $tarea->notas()->orderBy('created_at', 'desc')->get();
		if (count($notas) > 0)
		{
			foreach ($notas as $nota)
			{
				$data = [
					'id'          => $nota->id,
					'nota'        => $nota->nota,
					'publico'     => $nota->publico,
					'habilitado'  => $nota->habilitado,
					'creada'      => $nota->created_at->getTimestamp(),
					'actualizada' => $nota->updated_at->getTimestamp()
				];
				
				if ($nota->publico == 1)
				{
					array_push($notas_publicos, $data);
				}
				else
				{
					array_push($notas_privados, $data);
				}
				
				array_push($todas, $data);
			}
		}
		
		$data = [
			'id'                => $tarea->id,
			'ejecutivo'         => [
				'id'     => $tarea->ejecutivo->id,
				'nombre' => $tarea->ejecutivo->usuario->nombreCompleto(),
				'avatar' => $tarea->ejecutivo->avatar,
				'color'  => $tarea->ejecutivo->color,
				'class'  => $tarea->ejecutivo->class,
			],
			'estatus'           => [
				'id'      => $tarea->estatus->id,
				'estatus' => $tarea->estatus->estatus,
				'class'   => $tarea->estatus->class,
				'color'   => $tarea->estatus->color,
			],
			'caso'              => [
				'id'      => $tarea->caso->id,
				'avance'  => $tarea->caso->avance,
				'cliente' => [
					'id'          => $tarea->caso->cliente->id,
					'razonsocial' => $tarea->caso->cliente->razonsocial,
					'rfc'         => $tarea->caso->cliente->rfc,
				],
				'lider'   => [
					'id'     => $tarea->caso->casoLider->lider->id,
					'nombre' => $tarea->caso->casoLider->lider->usuario->nombreCompleto(),
				],
				'estatus' => [
					'id'      => $tarea->caso->estatus->id,
					'estatus' => $tarea->caso->estatus->estatus,
					'class'   => $tarea->caso->estatus->class,
					'color'   => $tarea->caso->estatus->color
				]
			],
			'titulo'            => $tarea->titulo,
			'descripcion'       => $tarea->descripcion,
			'avance'            => $tarea->avance,
			'fecha_inicio'   => (is_null($tarea->fecha_inicio)) ? null :  $tarea->fecha_inicio->getTimestamp(),
			'fecha_tentativa_cierre'      => (is_null($tarea->fecha_tentativa_cierre)) ? null : $tarea->fecha_tentativa_cierre->getTimestamp(),
			'fecha_cierre'      => (is_null($tarea->fecha_cierre)) ? null : $tarea->fecha_cierre->getTimestamp(),
			'duracion_minutos' => $tarea->duracion_minutos,
			'notas'             => [
				'publicas' => $notas_publicos,
				'privadas' => $notas_privados,
				'todas'    => $todas
			],
			'habilitado'        => $tarea->habilitado,
			'created_at'        => $tarea->created_at->getTimestamp()
		];
		
		return $data;
	}
}