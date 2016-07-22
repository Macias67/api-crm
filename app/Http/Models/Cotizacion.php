<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ct_cotizacion';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'ejecutivo_id',
		'cliente_id',
		'contacto_id',
		'oficina_id',
		'estatus_id'
	];
}
