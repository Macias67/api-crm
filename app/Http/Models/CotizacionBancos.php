<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class CotizacionBancos extends Model
{
	use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ct_cotizacion_bancos';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'id_cotizacion',
		'id_banco'
	];
	
	/**
	 * Un CotizacionBancos pertenece a una Cotizacion
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function cotizacion()
	{
		return $this->belongsTo(Cotizacion::class, 'id_cotizacion');
	}
	
	/**
	 * Un CotizacionBancos pertenece a un Producto
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function banco()
	{
		return $this->belongsTo(Bancos::class, 'id_banco');
	}
	
	public static function table()
	{
		return with(new static)->getTable();
	}
}
