<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CasoReasignacionLider extends Model
{
	//use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_caso_reasignacion_lider';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'caso_id',
		'lider_old',
		'lider_new',
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
