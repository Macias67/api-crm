<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ec_departamentos';
	
	protected $primaryKey = 'id';
	
	/**
	 * Un Departamento tiene muchos ejecutivos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ejecutivos()
	{
		return $this->hasMany(Ejecutivo::class, 'id');
	}
	
}
