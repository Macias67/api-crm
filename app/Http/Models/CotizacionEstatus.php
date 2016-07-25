<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CotizacionEstatus extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ct_cotizacion_estatus';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'estatus',
		'color'
	];
	
	/**
	 * Una CotizacionEstatus tiene muchas cotizaciones
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cotizaciones()
	{
		return $this->hasMany(Cotizacion::class, 'estatus_id');
	}
}
