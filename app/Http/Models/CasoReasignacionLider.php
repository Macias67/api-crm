<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class CasoReasignacionLider extends Model
{
	use SyncsWithFirebase;
	
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
