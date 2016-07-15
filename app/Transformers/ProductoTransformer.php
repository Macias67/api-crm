<?php
/**
 * User: Luis Macias
 * Date: 11/07/2016
 * Time: 05:16 PM
 */

namespace App\Transformers;


use App\Http\Models\Productos;
use League\Fractal\TransformerAbstract;

class ProductoTransformer extends TransformerAbstract
{
	public function transform(Productos $producto)
	{
		$data = [
			'id'         => $producto->id,
			'unidad'     => [
				'id' => $producto->unidad->id,
			        'unidad'  => $producto->unidad->unidad,
			        'plural' =>$producto->unidad->plural,
				'abreviatura' => $producto->unidad->abreviatura,
				'online' => (bool)$producto->unidad->online
			],
			'codigo'     => $producto->codigo,
			'producto'   => $producto->producto,
			'descripcion' => $producto->descripcion,
			'precio'     => $producto->precio,
			'online'     => (bool)$producto->online,
			'created_at' => $producto->created_at,
			'updated_at' => $producto->updated_at,
		];

		return $data;
	}
}