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
		'comentario',
		'valido',
		'created_at',
	        'updated_at'
	];
	
	/**
	 * Una CotizacionPago pertence a una Cotizacion
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cotizacion()
	{
		return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
	}
	
	/**
	 * Una CotizacionPago pertence a un Contacto
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function contacto()
	{
		return $this->belongsTo(Contactos::class, 'contacto_id');
	}
	
	/**
	 * Una CotizacionPago tiene muchos CotizacionComprobantes
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comprobantes()
	{
		return $this->hasMany(CotizacionComprobantes::class, 'pago_id');
	}
}
