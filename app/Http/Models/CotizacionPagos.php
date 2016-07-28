<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CotizacionPagos extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ct_cotizacion_pagos';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'cotizacion_id',
		'contacto_id',
		'cantidad',
		'created_at',
	        'updated_at'
	];
	
	/**
	 * Una CotizacionPago tiene muchas Cotizaciones
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cotizacion()
	{
		return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
	}
	
	/**
	 * Una CotizacionPago tiene muchas Cotizaciones
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function contacto()
	{
		return $this->belongsTo(Contactos::class, 'contacto_id');
	}
}
