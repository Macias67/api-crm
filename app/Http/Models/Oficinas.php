<?php

namespace App\Http\Models;

use App\Http\Models\Mutators\MOficinas;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Oficinas extends Model
{
	use SyncsWithFirebase;
	use MOficinas;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ec_oficinas';
	
	protected $primaryKey = 'id';

	protected $fillable = [
		'id',
		'calle',
		'numero',
		'colonia',
		'cp',
		'ciudad',
		'estado',
		'latitud',
		'longitud',
		'telefonos',
		'email',
		'online'
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
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at'
	];
	
	/**
	 * La oficina tiene muchos ejecutivos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ejecutivos()
	{
		return $this->hasMany(Ejecutivo::class, 'id');
	}

	public function scopeIsOnline($query)
	{
		return $query->where('online', TRUE);
	}
}
