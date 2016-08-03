<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CasoReasignacionLider extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_caso_reasignacion_lider';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id'
	];
	
	public static function table()
	{
		return with(new static)->getTable();
	}
}
