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
		'email',
		'telefono',
		'telefono2',
		'tipo',
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
	
	public function scopeIsOnline($query)
	{
		return $query->where('online', true);
	}
}
