<?php
/**
 * User: Luis
 * Date: 22/07/2016
 * Time: 12:01 PM
 */

namespace App\Transformers;

use App\Http\Models\Cotizacion;
use League\Fractal\TransformerAbstract;

class CotizacionTransformer extends TransformerAbstract
{
	public function transform(Cotizacion $cotizacion)
	{
		
		$productos = $cotizacion->productos;
		$dProductos = [];
		foreach ($productos as $index => $producto)
		{
			$dProductos[$index] = [
				'id'        => $producto->id_producto,
				'codigo'    => $producto->producto->codigo,
				'nombre'    => $producto->producto->producto,
				'cantidad'  => $producto->cantidad,
				'precio'    => (float)$producto->precio,
				'descuento' => (float)$producto->descuento,
				'subtotal'  => (float)$producto->subtotal,
				'iva'       => (float)$producto->iva,
				'total'     => (float)$producto->total
			];
		}
		
		$pagos = $cotizacion->pagos()->orderBy('created_at', 'desc')->get();
		$dtPagos = [];
		if (count($pagos) > 0)
		{
			foreach ($pagos  as $index => $pago)
			{
				$dtPagos[$index] = [
					'id' => $pago->id,
					'contacto_id' => $pago->contacto->id,
					'contacto' => $pago->contacto->nombreCompleto(),
				        'cantidad' => (float)$pago->cantidad,
				        'fecha' =>date('Y-m-d H:i:s', strtotime($pago->created_at)),
				];
			}
			
		}
		
		$data = [
			'id'          => $cotizacion->id,
			'cliente'     => [
				'id'          => $cotizacion->cliente->id,
				'razonsocial' => $cotizacion->cliente->razonsocial,
			],
			'ejecutivo'   => [
				'id'       => $cotizacion->ejecutivo->id,
				'nombre'   => $cotizacion->ejecutivo->nombre,
				'apellido' => $cotizacion->ejecutivo->apellido,
				'email'    => $cotizacion->ejecutivo->email
			],
			'contacto'    => [
				'id'       => $cotizacion->contacto->id,
				'nombre'   => $cotizacion->contacto->nombre,
				'apellido' => $cotizacion->contacto->apellido,
				'email'    => $cotizacion->contacto->email
			],
			'oficina'     => [
				'id'     => $cotizacion->oficina->id,
				'ciudad' => $cotizacion->oficina->ciudad,
				'estado' => $cotizacion->oficina->estado
			],
			'pagos'       => $dtPagos,
			'estatus'     => [
				'id'      => $cotizacion->estatus->id,
				'estatus' => $cotizacion->estatus->estatus,
				'color'   => $cotizacion->estatus->color,
			],
			'productos'   => $dProductos,
			'fecha'       => date('Y-m-d H:i:s', strtotime($cotizacion->created_at)),
			'vencimiento' => $cotizacion->vencimiento,
			'cxc'         => (bool)$cotizacion->cxc,
			'subtotal'    => (float)$cotizacion->subtotal,
			'iva'         => (float)$cotizacion->iva,
			'total'       => (float)$cotizacion->total,
		];
		
		return $data;
	}
}