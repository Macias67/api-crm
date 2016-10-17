<?php
/**
 * User: Luis Macias
 * Date: 05/08/2016
 * Time: 05:10 PM
 */

namespace App\Transformers;

use App\Http\Models\Caso;
use League\Fractal\TransformerAbstract;

class CasoTransformer extends TransformerAbstract
{
	public function transform(Caso $caso)
	{
		$cotizacion = null;
		// Si tiene cotizacion
		if (!is_null($caso->casoCotizacion))
		{
			$cotizacion = $caso->casoCotizacion->cotizacion;
			
			$productos = $cotizacion->productos;
			$dProductos = [];
			foreach ($productos as $index => $producto)
			{
				$dProductos[$index] = [
					'id'          => $producto->id_producto,
					'codigo'      => $producto->producto->codigo,
					'nombre'      => $producto->producto->producto,
					'habilitado'  => $producto->habilitado,
					'descripcion' => $producto->producto->descripcion,
					'cantidad'    => $producto->cantidad,
					'precio'      => $producto->precio,
					'descuento'   => $producto->descuento,
					'subtotal'    => $producto->subtotal,
					'iva'         => $producto->iva,
					'total'       => $producto->total
				];
			}
			
			$cotizacion = [
				'id'          => $cotizacion->id,
				'ejecutivo'   => [
					'id'     => $cotizacion->ejecutivo->usuario->id,
					'nombre' => $cotizacion->ejecutivo->usuario->nombreCompleto(),
					'online' => $cotizacion->ejecutivo->usuario->online,
				],
				'contacto'    => [
					'id'       => $cotizacion->contacto->usuario->id,
					'nombre'   => $cotizacion->contacto->usuario->nombreCompleto(),
					'email'    => $cotizacion->contacto->usuario->email,
					'telefono' => $cotizacion->contacto->telefono,
					'online'   => $cotizacion->contacto->usuario->online,
				],
				'oficina'     => [
					'id'     => $cotizacion->oficina->id,
					'ciudad' => $cotizacion->oficina->ciudad
				],
				'estatus'     => [
					'id'      => $cotizacion->estatus->id,
					'estatus' => $cotizacion->estatus->estatus,
					'class'   => $cotizacion->estatus->class,
					'color'   => $cotizacion->estatus->color
				],
				'productos'   => $dProductos,
				'vencimiento' => $cotizacion->vencimiento,
				'validacion'  => $caso->casoCotizacion->fecha_validacion->getTimestamp(),
				'cxc'         => $cotizacion->cxc,
				'subtotal'    => $cotizacion->subtotal,
				'iva'         => $cotizacion->iva,
				'total'       => $cotizacion->total
			];
		}
		
		$ejecutivo = null;
		// Si tiene lider el caso
		if (!is_null($caso->casoLider))
		{
			$ejecutivo = [
				'nombre' => $caso->casoLider->lider->usuario->nombreCompleto(),
				'fecha'  => $caso->casoLider->created_at->getTimestamp()
			];
		}
		
		$tareas = [];
		if (count($caso->tareas) > 0)
		{
			$tareas = $caso->tareas;
			foreach ($tareas as $index => $tarea)
			{
				$notas_publicos = [];
				$notas_privados = [];
				
				$notas = $tarea->notas;
				if (count($notas) > 0)
				{
					foreach ($notas as $nota)
					{
						$data = [
							'id'          => $nota->id,
							'nota'        => $nota->nota,
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
					}
				}
				
				$tareas[$index] = [
					'id'                     => $tarea->id,
					'ejecutivo'              => [
						'id'     => $tarea->ejecutivo->usuario->id,
						'nombre' => $tarea->ejecutivo->usuario->nombreCompleto(),
						'avatar' => $tarea->ejecutivo->usuario->avatar,
						'color'  => $tarea->ejecutivo->color,
						'class'  => $tarea->ejecutivo->class,
					],
					'estatus'                => [
						'id'      => $tarea->estatus->id,
						'estatus' => $tarea->estatus->estatus,
						'class'   => $tarea->estatus->class,
						'color'   => $tarea->estatus->color,
					],
					'titulo'                 => $tarea->titulo,
					'descripcion'            => $tarea->descripcion,
					'avance'                 => $tarea->avance,
					'fecha_inicio'           => (is_null($tarea->fecha_inicio)) ? null : $tarea->fecha_inicio->getTimestamp(),
					'fecha_tentativa_cierre' => (is_null($tarea->fecha_tentativa_cierre)) ? null : $tarea->fecha_tentativa_cierre->getTimestamp(),
					'fecha_cierre'           => (is_null($tarea->fecha_cierre)) ? null : $tarea->fecha_cierre->getTimestamp(),
					'duracion_minutos'       => $tarea->duracion_minutos,
					'notas'                  => [
						'publicas' => $notas_publicos,
						'privadas' => $notas_privados
					],
					'habilitado'             => $tarea->habilitado,
					'creado'                 => $tarea->created_at->getTimestamp()
				];
			}
		}
		
		$data = [
			'id'                   => $caso->id,
			'cliente'              => [
				'id'           => $caso->cliente->id,
				'razonsocial'  => $caso->cliente->razonsocial,
				'rfc'          => $caso->cliente->rfc,
				'email'        => $caso->cliente->email,
				'distribuidor' => $caso->cliente->distribuidor,
			],
			'estatus'              => [
				'id'      => $caso->estatus->id,
				'estatus' => $caso->estatus->estatus,
				'class'   => $caso->estatus->class,
				'color'   => $caso->estatus->color
			],
			'cotizacion'           => $cotizacion,
			'asignado'             => $caso->asignado,
			'avance'               => $caso->avance,
			'lider'                => $ejecutivo,
			'tareas'               => $tareas,
			'fechainicio'          => (is_null($caso->fecha_inicio)) ? null : $caso->fecha_inicio->getTimestamp(),
			'fechatentativacierre' => (is_null($caso->fecha_tentativa_cierre)) ? null : $caso->fecha_tentativa_cierre->getTimestamp(),
			'fechatermino'         => (is_null($caso->fecha_termino)) ? null : $caso->fecha_termino->getTimestamp(),
			'registro'             => $caso->created_at->getTimestamp()
		];
		
		return $data;
	}
}