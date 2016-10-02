<?php
/**
 * User: Luis
 * Date: 18/09/2016
 * Time: 02:53 PM
 */

namespace App\Transformers;


use App\Http\Models\Contactos;
use League\Fractal\TransformerAbstract;

class ContactoTransformer extends TransformerAbstract
{
	public function transform(Contactos $contacto)
	{
		$data = [
			'id'         => $contacto->usuario->id,
			'nombre'     => $contacto->usuario->nombre,
			'apellido'   => $contacto->usuario->apellido,
			'email'      => $contacto->usuario->email,
			'online'     => $contacto->usuario->online,
			'cliente'    => [
				'id'           => $contacto->cliente->id,
				'razonsocial'  => $contacto->cliente->razonsocial,
				'rfc'          => $contacto->cliente->rfc,
				'prospecto'    => $contacto->cliente->prospecto,
				'distribuidor' => $contacto->cliente->distribuidor,
				'email'        => $contacto->cliente->email,
				'online'       => $contacto->cliente->online,
			],
			'created_at' => $contacto->created_at->getTimestamp(),
			'updated_at' => $contacto->updated_at->getTimestamp()
		];
		
		if (isset($contacto->token))
		{
			$data['token'] = $contacto->token;
		}
		
		return $data;
	}
}