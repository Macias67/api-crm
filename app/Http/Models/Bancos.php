<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Bancos extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ec_bancos';

	protected $primaryKey = 'id';

	protected $fillable = [
		'id',
		'banco',
		'sucursal',
		'cta',
		'titular',
		'cib',
		'online',
	];
	
	/**
	 * Un Banco tiene muchos CotizacionBancos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cotizacionBancos()
	{
		return $this->hasMany(CotizacionBancos::class, 'id_banco');
	}
	
	public function scopeIsOnline($query)
	{
		return $query->where('online', TRUE);
	}
}
