<?php
/**
 * User: Luis Macias
 * Date: 04/07/2016
 * Time: 06:54 PM
 */

namespace App\Transformers;


use App\Http\Models\ClienteContactos;
use League\Fractal\TransformerAbstract;

class ClienteContactoTransformer extends TransformerAbstract
{
	public function transform(ClienteContactos $contacto)
	{
		$data = [
			'id'         => $contacto->usuario->id,
			'nombre'     => $contacto->usuario->nombre,
			'apellido'   => $contacto->usuario->apellido,
			'email'      => $contacto->usuario->email,
			'telefono'   => $contacto->telefono,
			'online'     => $contacto->usuario->online,
			'cliente'    => [
				'id'          => $contacto->cliente->id,
				'razonsocial' => $contacto->cliente->razonsocial,
				'rfc'         => $contacto->cliente->rfc,
				'razonsocial' => $contacto->cliente->razonsocial,
			],
			'created_at' => $contacto->created_at->getTimestamp(),
			'updated_at' => $contacto->updated_at->getTimestamp()
		];
		
		return $data;
	}
}