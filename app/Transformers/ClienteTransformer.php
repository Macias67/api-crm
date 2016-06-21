<?php
/**
 * User: Luis Macias
 * Date: 20/06/2016
 * Time: 05:35 PM
 */

namespace App\Transformers;

use App\Http\Models\Clientes;
use League\Fractal\TransformerAbstract;

class ClienteTransformer extends TransformerAbstract
{
	public function transform(Clientes $cliente)
	{
		$data = [
			'id'          => $cliente->id,
			'razonsocial' => $cliente->razonsocial,
			'rfc'         => $cliente->rfc,
			'email'       => $cliente->email,
			'telefono'    => $cliente->telefono,
			'telefono2'   => $cliente->telefono2,
			'tipo'        => $cliente->tipo,
			'calle'       => $cliente->calle,
			'noexterior'  => $cliente->noexterior,
			'nointerior'  => $cliente->nointerior,
			'colonia'     => $cliente->colonia,
			'cp'          => $cliente->cp,
			'ciudad'      => $cliente->ciudad,
			'municipio'   => $cliente->municipio,
			'estado'      => $cliente->estado,
			'pais'        => $cliente->pais,
			'created_at'  => $cliente->created_at,
			'updated_at'  => $cliente->updated_at
		];
		
		return $data;
	}
}