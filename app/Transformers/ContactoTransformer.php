<?php
/**
 * User: Luis Macias
 * Date: 04/07/2016
 * Time: 06:54 PM
 */

namespace App\Transformers;


use App\Http\Models\ClienteContactos;
use League\Fractal\TransformerAbstract;

class ContactoTransformer extends TransformerAbstract
{
	public function transform(ClienteContactos $contacto)
	{
		$data = [
			'id'         => $contacto->id,
			'nombre'     => $contacto->nombre,
			'apellido'   => $contacto->apellido,
			'email'      => $contacto->email,
			'telefono'   => $contacto->telefono,
			'online'     => (bool)$contacto->online,
			'cliente' => $contacto->cliente,
			'created_at' => $contacto->created_at,
			'updated_at' => $contacto->updated_at
		];
		
		return $data;
	}
}