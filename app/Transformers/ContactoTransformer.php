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
			'id'         => $contacto->id,
			'nombre'     => $contacto->nombre,
			'apellido'   => $contacto->apellido,
			'email'      => $contacto->email,
			'online'     => (bool)$contacto->online,
			'cliente' => [
				'id' => $contacto->cliente->id,
			        'razonsocial' =>  $contacto->cliente->razonsocial,
			        'rfc' =>  $contacto->cliente->rfc,
				'prospecto' =>  (bool)$contacto->cliente->prospecto,
				'distribuidor' =>  (bool)$contacto->cliente->distribuidor,
				'email' =>  $contacto->cliente->email,
				'online' =>  $contacto->cliente->online,
			],
			'created_at' => date('Y-m-d H:i:s', strtotime($contacto->created_at)),
			'updated_at' => date('Y-m-d H:i:s', strtotime($contacto->updated_at))
		];
		
		if (isset($contacto->token))
		{
			$data['token'] = $contacto->token;
		}
		
		if (isset($contacto->esCliente))
		{
			$data['esCliente'] = $contacto->esCliente;
		}
		
		return $data;
	}
}