<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CasoEncuesta extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_caso_encuesta';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'id_caso',
		'id_contacto',
		'respondida',
		'respuestas_json',
		'puntaje',
		'created_at',
		'updated_at'
	];
	
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'respondida'      => 'boolean',
		'respuestas_json' => 'array',
		'puntaje'         => 'float'
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
	
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	/**
	 * Un CasoEncuesta tiene un Caso
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function caso()
	{
		return $this->hasOne(Caso::class, 'id_caso');
	}
}
