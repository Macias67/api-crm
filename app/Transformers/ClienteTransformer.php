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

		$contactos = $cliente->contactos;
		$dContactos = [];

		foreach ($contactos as $index => $contacto)
		{
			$dContactos[$index] = [
				'id'       => $contacto->usuario->id,
				'nombre'   => $contacto->usuario->nombre,
				'apellido' => $contacto->usuario->apellido,
				'email'    => $contacto->usuario->email,
				'telefono' => $contacto->telefono,
				'online'   => $contacto->usuario->online
			];
		}

		$data = [
			'id'           => $cliente->id,
			'razonsocial'  => $cliente->razonsocial,
			'rfc'          => $cliente->rfc,
			'prospecto'    => (bool)$cliente->prospecto,
			'distribuidor' => (bool)$cliente->distribuidor,
			'email'        => $cliente->email,
			'telefono'     => $cliente->telefono,
			'telefono2'    => $cliente->telefono2,
			'calle'        => $cliente->calle,
			'noexterior'   => $cliente->noexterior,
			'nointerior'   => $cliente->nointerior,
			'colonia'      => $cliente->colonia,
			'cp'           => $cliente->cp,
			'ciudad'       => $cliente->ciudad,
			'municipio'    => $cliente->municipio,
			'estado'       => $cliente->estado,
			'pais'         => $cliente->pais,
			'online'       => (bool)$cliente->online,
			'contactos'    => $dContactos,
			'created_at'   => $cliente->created_at->getTimestamp(),
			'updated_at'   => $cliente->updated_at->getTimestamp()
		];
		
		return $data;
	}
}