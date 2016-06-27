<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
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
