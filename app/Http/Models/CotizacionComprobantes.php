<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CotizacionComprobantes extends Model
{
	//use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ct_cotizacion_comprobantes';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'pago_id',
		'download_url',
		'content_type',
		'full_path',
		'md5hash',
		'name',
		'size',
		'created_at',
		'updated_at'
	];
	
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'size' => 'integer'
	];
	
	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at'
	];
	
	/**
	 * Una CotizacionComprobantes pertence a una CotizacionPagos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function pago()
	{
		return $this->belongsTo(CotizacionPagos::class, 'pago_id');
	}
}
