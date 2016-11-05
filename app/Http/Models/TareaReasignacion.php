<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TareaReasignacion extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ct_tarea_reasignacion';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'id_tarea',
		'ejecutivo_old',
		'ejecutivo_new',
		'motivo',
		'created_at',
		'updated_at'
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
}
