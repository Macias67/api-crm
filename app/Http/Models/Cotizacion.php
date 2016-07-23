<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ct_cotizacion';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'ejecutivo_id',
		'cliente_id',
		'contacto_id',
		'oficina_id',
		'estatus_id'
	];
	
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	/**
	 * Una Cotizacion tiene muchos productos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function productos()
	{
		return $this->hasMany(CotizacionProductos::class, 'id_cotizacion');
	}
	
	/**
	 * Una Cotizacion tiene muchos bancos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function bancos()
	{
		return $this->hasMany(CotizacionBancos::class, 'id_cotizacion');
	}
}
