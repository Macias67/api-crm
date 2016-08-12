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
					'id'     => $cotizacion->contacto->id,
					'nombre' => $cotizacion->contacto->nombreCompleto(),
					'email'  => $cotizacion->contacto->email,
					'online' => (bool)$cotizacion->contacto->online,
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
		if (!is_null($caso->casoLider))
		{
			$ejecutivo = $caso->casoLider->lider;
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
			'fechainicio'          => $caso->fecha_inicio,
			'fechatentativacierre' => $caso->fecha_tentativa_cierre,
			'fechatermino'         => $caso->fecha_termino,
			'registro'             => date('Y-m-d H:i:s', strtotime($caso->created_at))
		];
		
		return $data;
	}
}