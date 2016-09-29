<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Productos extends Model
{
	use SyncsWithFirebase;
	
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
		return $this->belongsTo(UnidadesProductos::class, 'id_unidad');
	}
	
	/**
	 * Un Producto tiene muchos CotizacionProductos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cotizacionProductos()
	{
		return $this->hasMany(CotizacionProductos::class, 'id_cotizacion');
	}
	
	public function scopeIsOnline($query)
	{
		return $query->where('online', true);
	}
}
