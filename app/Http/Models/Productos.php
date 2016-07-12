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
		'id_unidad',
		'codigo',
		'producto',
		'descripcion',
		'precio',
		'online',
	];
	
	/**
	 * Un Producto tiene muchas unidades
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function unidad()
	{
		return $this->belongsTo(UnidadesProductos::class, 'id');
	}
	
	public function scopeIsOnline($query)
	{
		return $query->where('online', true);
	}
}
