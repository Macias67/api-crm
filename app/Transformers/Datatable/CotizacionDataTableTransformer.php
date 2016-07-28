<?php
/**
 * User: Luis Macias
 * Date: 26/07/2016
 * Time: 04:31 PM
 */

namespace App\Transformers\Datatable;

use App\Http\Models\Cotizacion;
use League\Fractal\TransformerAbstract;

class CotizacionDataTableTransformer extends TransformerAbstract
{
	public function transform(Cotizacion $cotizacion)
	{
		$data = [
			'id'          => $cotizacion->id,
			'razonsocial' => $cotizacion->cliente->razonsocial,
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
			'estatus' => [
				'id' => $cotizacion->estatus->id,
				'estatus' => $cotizacion->estatus->estatus,
				'color' => $cotizacion->estatus->color,
			],
			'vencimiento' => $cotizacion->vencimiento,
			'cxc'         => (bool)$cotizacion->cxc,
			'subtotal'    => (float)$cotizacion->subtotal,
			'iva'         => (float)$cotizacion->iva,
			'total'       => (float)$cotizacion->total,
		];
		
		return $data;
	}
}