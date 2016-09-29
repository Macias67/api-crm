<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Bancos extends Model
{
	use SyncsWithFirebase;
	
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
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'online'    => 'boolean'
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
		return $query->where('online', true);
	}
}
