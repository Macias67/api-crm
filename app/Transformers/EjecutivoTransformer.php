<?php
/**
 * User: Luis
 * Date: 22/05/2016
 * Time: 12:36 PM
 */

namespace App\Transformers;

use App\Http\Models\Ejecutivo;
use League\Fractal\TransformerAbstract;

class EjecutivoTransformer extends TransformerAbstract
{
	public function transform(Ejecutivo $ejecutivo)
	{
		$oficina = $ejecutivo->oficina;
		$agenda = [];
		$dAgenda = $ejecutivo->agenda;
		foreach ($dAgenda as $index => $evento)
		{
			$agenda[$index] = [
				'id'          => $evento->id,
				'titulo'      => $evento->titulo,
				'descripcion' => $evento->descripcion,
				'allDay'      => $evento->allDay,
				'start'       => $evento->start->getTimestamp(),
				'end'         => $evento->end->getTimestamp(),
				'url'         => $evento->url,
				'creado'      => $evento->created_at->getTimestamp(),
			];
		}
		
		$data = [
			'id'           => $ejecutivo->usuario->id,
			'nombre'       => $ejecutivo->usuario->nombre,
			'apellido'     => $ejecutivo->usuario->apellido,
			'email'        => $ejecutivo->usuario->email,
			'avatar'       => $ejecutivo->usuario->avatar,
			'online'       => $ejecutivo->usuario->online,
			'oficina'      => [
				'calle'     => $oficina->calle,
				'numero'    => $oficina->numero,
				'colonia'   => $oficina->colonia,
				'cp'        => $oficina->cp,
				'ciudad'    => $oficina->ciudad,
				'estado'    => $oficina->estado,
				'latitud'   => $oficina->latitud,
				'longitud'  => $oficina->longitud,
				'telefonos' => explode(',', $oficina->telefonos),
				'email'     => $oficina->email,
			],
			'agenda'       => $agenda,
			'departamento' => $ejecutivo->departamento,
			'created_at'   => $ejecutivo->created_at->getTimestamp(),
			'updated_at'   => $ejecutivo->updated_at->getTimestamp()
		];
		
		if (isset($ejecutivo->token))
		{
			$data['token'] = $ejecutivo->token;
		}
		
		return $data;
	}
}