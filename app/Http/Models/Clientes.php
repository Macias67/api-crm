<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Clientes extends Model
{
	use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cl_clientes';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'razonsocial',
		'rfc',
		'prospecto',
		'distribuidor',
		'email',
		'telefono',
		'telefono2',
		'calle',
		'noexterior',
		'nointerior',
		'colonia',
		'cp',
		'ciudad',
		'municipio',
		'estado',
		'pais',
		'online'
	];
	
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'prospecto' => 'boolean',
		'distribuidor' => 'boolean',
		'online' => 'boolean'
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
	 * Un Cliente tiene muchos contactos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function contactos()
	{
		return $this->hasMany(Contactos::class, 'id_cliente');
	}
	
	/**
	 * Un Cliente tiene muchas cotizaciones
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cotizaciones()
	{
		return $this->hasMany(Cotizacion::class, 'cliente_id');
	}
	
	/**
	 * Un Cliente tiene muchos Casos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function casos()
	{
		return $this->hasMany(Caso::class, 'cliente_id');
	}
	
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	public function scopeIsOnline($query)
	{
		return $query->where('online', true);
	}
	
	public function scopeIsProspecto($query)
	{
		return $query->where('prospecto', true);
	}
	
	public function scopeIsDistribuidor($query)
	{
		return $query->where('distribuidor', true);
	}
}
