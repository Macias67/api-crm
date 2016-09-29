<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class CotizacionComprobantes extends Model
{
	use SyncsWithFirebase;
	
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
		'archivo',
		'nombre',
		'extension',
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
