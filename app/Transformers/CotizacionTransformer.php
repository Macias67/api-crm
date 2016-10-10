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
				'id'          => $producto->id_producto,
				'habilitado'  => $producto->habilitado,
				'codigo'      => $producto->producto->codigo,
				'nombre'      => $producto->producto->producto,
				'descripcion' => $producto->producto->descripcion,
				'cantidad'    => $producto->cantidad,
				'precio'      => $producto->precio,
				'descuento'   => $producto->descuento,
				'subtotal'    => $producto->subtotal,
				'iva'         => $producto->iva,
				'total'       => $producto->total,
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
						'id'           => $comprobante->id,
						'name'         => $comprobante->name,
						'download_url' => $comprobante->download_url,
						'content_type' => $comprobante->content_type,
						'full_path'    => $comprobante->full_path,
						'md5hash'      => $comprobante->md5hash,
						'size'         => $comprobante->size,
						'fecha'        => $comprobante->created_at->getTimestamp()
					];
				}
				
				$dtPagos[$indexP] = [
					'id'           => $pago->id,
					'contacto_id'  => $pago->contacto->id,
					'contacto'     => $pago->contacto->usuario->nombreCompleto(),
					'cantidad'     => $pago->cantidad,
					'tipo'     => $pago->tipo,
					'comentario'   => (is_null($pago->comentario)) ? '' : $pago->comentario,
					'fecha'        => $pago->created_at->getTimestamp(),
					'valido'       => $pago->valido,
					'comprobantes' => $dtComprobantres
				];
			}
			
		}
		
		$data = [
			'id'          => $cotizacion->id,
			'cliente'     => [
				'id'           => $cotizacion->cliente->id,
				'razonsocial'  => $cotizacion->cliente->razonsocial,
				'distribuidor' => (boolean)$cotizacion->cliente->distribuidor,
			],
			'ejecutivo'   => [
				'id'     => $cotizacion->ejecutivo->usuario->id,
				'nombre' => $cotizacion->ejecutivo->usuario->nombreCompleto(),
				'email'  => $cotizacion->ejecutivo->usuario->email
			],
			'contacto'    => [
				'id'       => $cotizacion->contacto->usuario->id,
				'nombre'   => $cotizacion->contacto->usuario->nombreCompleto(),
				'telefono' => $cotizacion->contacto->telefono,
				'email'    => $cotizacion->contacto->usuario->email,
				'online'   => $cotizacion->contacto->usuario->online
			],
			'oficina'     => [
				'id'        => $cotizacion->oficina->id,
				'telefonos' => $cotizacion->oficina->telefonos,
				'ciudad'    => $cotizacion->oficina->ciudad,
				'estado'    => $cotizacion->oficina->estado
			],
			'pagos'       => $dtPagos,
			'estatus'     => [
				'id'      => $cotizacion->estatus->id,
				'estatus' => $cotizacion->estatus->estatus,
				'class'   => $cotizacion->estatus->class,
				'color'   => $cotizacion->estatus->color,
			],
			'productos'   => $dProductos,
			'fecha'       => $cotizacion->created_at->getTimestamp(),
			'vencimiento' => $cotizacion->vencimiento->getTimestamp(),
			'cxc'         => $cotizacion->cxc,
			'subtotal'    => $cotizacion->subtotal,
			'iva'         => $cotizacion->iva,
			'total'       => $cotizacion->total,
		];
		
		return $data;
	}
}