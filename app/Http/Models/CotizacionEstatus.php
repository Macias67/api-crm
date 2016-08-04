<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CotizacionEstatus extends Model
{
	
	const PORPAGAR  = 1;
	const REVISION  = 2;
	const IRREGULAR = 3;
	const PAGADA    = 4;
	const ABONADA   = 5;
	const VENCIDA   = 6;
	const CANCELADA = 7;
	
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
		'class',
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
