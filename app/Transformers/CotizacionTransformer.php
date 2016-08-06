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
			        'habilitado' => (bool)$producto->habilitado,
				'codigo'    => $producto->producto->codigo,
				'nombre'    => $producto->producto->producto,
				'descripcion'    => $producto->producto->descripcion,
				'cantidad'  => $producto->cantidad,
				'precio'    => (float)$producto->precio,
				'descuento' => (float)$producto->descuento,
				'subtotal'  => (float)$producto->subtotal,
				'iva'       => (float)$producto->iva,
				'total'     => (float)$producto->total,
			];
		}
		
		$pagos = $cotizacion->pagos()->orderBy('created_at', 'desc')->get();
		$dtPagos = [];
		if (count($pagos) > 0)
		{
			foreach ($pagos as $indexP => $pago)
			{
				$comprobantes = $pago->comprobantes;
				$dtComprobantres = [];
				
				foreach ($comprobantes as $index => $comprobante)
				{
					$dtComprobantres[$index] = [
						'id'       => $comprobante->id,
						'archivo'  => $comprobante->archivo,
						'nombre'   => $comprobante->nombre,
						'extension' => $comprobante->extension,
						'fecha'    => date('Y-m-d H:i:s', strtotime($comprobante->created_at))
					];
				}
				
				$dtPagos[$indexP] = [
					'id'           => $pago->id,
					'contacto_id'  => $pago->contacto->id,
					'contacto'     => $pago->contacto->nombreCompleto(),
					'cantidad'     => (float)$pago->cantidad,
					'comentario'     => (is_null($pago->comentario)) ? '' : $pago->comentario,
					'fecha'        => date('Y-m-d H:i:s', strtotime($pago->created_at)),
					'valido' => (bool)$pago->valido,
					'comprobantes' => $dtComprobantres
				];
			}
			
		}
		
		$data = [
			'id'          => $cotizacion->id,
			'cliente'     => [
				'id'          => $cotizacion->cliente->id,
				'razonsocial' => $cotizacion->cliente->razonsocial,
			        'distribuidor' => (boolean)$cotizacion->cliente->distribuidor,
			],
			'ejecutivo'   => [
				'id'       => $cotizacion->ejecutivo->id,
				'nombre'   => $cotizacion->ejecutivo->nombreCompleto(),
				'email'    => $cotizacion->ejecutivo->email
			],
			'contacto'    => [
				'id'       => $cotizacion->contacto->id,
				'nombre'   => $cotizacion->contacto->nombreCompleto(),
				'telefono' => $cotizacion->contacto->telefono,
				'email'    => $cotizacion->contacto->email,
			        'online' => (bool)$cotizacion->contacto->online
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