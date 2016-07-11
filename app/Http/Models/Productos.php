<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ec_productos';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'unidad',
		'codigo',
		'producto',
		'precio',
		'online',
	];
	
	public function scopeIsOnline($query)
	{
		return $query->where('online', true);
	}
}
