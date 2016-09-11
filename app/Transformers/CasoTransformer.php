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
					'habilitado'  => (bool)$producto->habilitado,
					'descripcion' => $producto->producto->descripcion,
					'cantidad'    => $producto->cantidad,
					'precio'      => (float)$producto->precio,
					'descuento'   => (float)$producto->descuento,
					'subtotal'    => (float)$producto->subtotal,
					'iva'         => (float)$producto->iva,
					'total'       => (float)$producto->total
				];
			}
			
			$cotizacion = [
				'id'          => $cotizacion->id,
				'ejecutivo'   => [
					'id'     => $cotizacion->ejecutivo->id,
					'nombre' => $cotizacion->ejecutivo->nombreCompleto(),
					'online' => (bool)$cotizacion->ejecutivo->online,
				],
				'contacto'    => [
					'id'       => $cotizacion->contacto->id,
					'nombre'   => $cotizacion->contacto->nombreCompleto(),
					'email'    => $cotizacion->contacto->email,
					'telefono' => $cotizacion->contacto->telefono,
					'online'   => (bool)$cotizacion->contacto->online,
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
				'validacion'  => $caso->casoCotizacion->fecha_validacion,
				'cxc'         => (bool)$cotizacion->cxc,
				'subtotal'    => (float)$cotizacion->subtotal,
				'iva'         => (float)$cotizacion->iva,
				'total'       => (float)$cotizacion->total
			];
		}
		
		$ejecutivo = null;
		// Si tiene lider el caso
		if (!is_null($caso->casoLider))
		{
			$ejecutivo = [
				'nombre'      => $caso->casoLider->lider->nombreCompleto(),
				'asignadopor' => $caso->casoLider->asignadopor->nombreCompleto(),
				'fecha'       => date('Y-m-d H:i:s', strtotime($caso->casoLider->created_at))
			];
		}
		
		$tareas = [];
		if (count($caso->tareas) > 0)
		{
			$tareas = $caso->tareas;
			foreach ($tareas as $index => $tarea)
			{
				$tareas[$index] = [
					'id'                => $tarea->id,
					'ejecutivo'         => [
						'id'     => $tarea->ejecutivo->id,
						'nombre' => $tarea->ejecutivo->nombreCompleto(),
						'avatar' => $tarea->ejecutivo->avatar,
						'color' => $tarea->ejecutivo->color,
						'class' => $tarea->ejecutivo->class,
					],
					'estatus'           => [
						'id'      => $tarea->estatus->id,
						'estatus' => $tarea->estatus->estatus,
						'class'   => $tarea->estatus->class,
						'color'   => $tarea->estatus->color,
					],
					'titulo'            => $tarea->titulo,
					'descripcion'       => $tarea->descripcion,
					'avance'            => $tarea->avance,
					'fecha_tentativa'   => (is_null($tarea->fecha_tentativa)) ? null : date('Y-m-d H:i:s', strtotime($tarea->fecha_tentativa)),
					'fecha_cierre'      => (is_null($tarea->fecha_cierre)) ? null : date('Y-m-d H:i:s', strtotime($tarea->fecha_cierre)),
					'duracion_segundos' => $tarea->duracion_segundos,
					'habilitado'        => (bool)$tarea->habilitado,
					'creado'            => date('Y-m-d H:i:s', strtotime($tarea->created_at))
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
				'distribuidor' => (bool)$caso->cliente->distribuidor,
			],
			'estatus'              => [
				'id'      => $caso->estatus->id,
				'estatus' => $caso->estatus->estatus,
				'class'   => $caso->estatus->class,
				'color'   => $caso->estatus->color
			],
			'cotizacion'           => $cotizacion,
			'asignado'             => (bool)$caso->asignado,
			'lider'                => $ejecutivo,
			'tareas'               => $tareas,
			'fechainicio'          => $caso->fecha_inicio,
			'fechatentativacierre' => $caso->fecha_tentativa_cierre,
			'fechatermino'         => $caso->fecha_termino,
			'registro'             => date('Y-m-d H:i:s', strtotime($caso->created_at))
		];
		
		return $data;
	}
}