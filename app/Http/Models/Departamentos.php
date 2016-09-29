<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
	use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ec_departamentos';
	
	protected $primaryKey = 'id';
	
	public $timestamps = false;
	
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
