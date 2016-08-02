<?php
/**
 * User: Luis Macias
 * Date: 01/08/2016
 * Time: 08:06 PM
 */

namespace App\Transformers;

use App\Http\Models\CotizacionPagos;
use League\Fractal\TransformerAbstract;

class CotizacionPagosTransformer extends TransformerAbstract
{
	public function transform(CotizacionPagos $pago)
	{
		$comprobantes = $pago->comprobantes;
		$dtComprobantres = [];
		
		foreach ($comprobantes as $index => $comprobante)
		{
			$dtComprobantres[$index] = [
				'id'        => $comprobante->id,
				'archivo'   => $comprobante->archivo,
				'nombre'    => $comprobante->nombre,
				'extension' => $comprobante->extension,
				'fecha'     => date('Y-m-d H:i:s', strtotime($comprobante->created_at))
			];
		}
		
		$data = [
			'id'           => $pago->id,
			'contacto'     => [
				'id'     => $pago->contacto->id,
				'nombre' => $pago->contacto->nombreCompleto(),
				'email'  => $pago->contacto->email,
				'online' => (bool)$pago->contacto->online
			],
			'cliente'      => [
				'id'          => $pago->contacto->cliente->id,
				'razonsocial' => $pago->contacto->cliente->razonsocial,
				'rfc'         => $pago->contacto->cliente->rfc,
			],
			'cantidad'     => (float)$pago->cantidad,
			'comentario'   => (is_null($pago->comentario)) ? '' : $pago->comentario,
			'valido'       => (bool)$pago->valido,
			'fecha'        => date('Y-m-d H:i:s', strtotime($pago->created_at)),
			'comprobantes' => $dtComprobantres
		];
		
		return $data;
	}
}