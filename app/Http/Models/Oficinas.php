<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Oficinas extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ec_oficinas';
	
	protected $primaryKey = 'id';
	
	/**
	 * La oficina tiene muchos ejecutivos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ejecutivos()
	{
		return $this->hasMany(Ejecutivo::class, 'id');
	}
}
