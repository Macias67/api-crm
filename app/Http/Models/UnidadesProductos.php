<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadesProductos extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ec_unidad_productos';
	
	protected $primaryKey = 'id';
	
	public $timestamps = false;
	
	protected $fillable = [
		'id',
		'unidad'
	];
}
