<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class TareaEstatus extends Model
{
	//use SyncsWithFirebase;
	
	const ASIGNADO   = 1;
	const REASIGNADO = 2;
	const PROCESO    = 3;
	const CERRADO    = 4;
	const SUSPENDIDO = 5;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_tarea_estatus';
	
	protected $primaryKey = 'id';
	
	public $timestamps = false;
	
	protected $fillable = [
		'id',
		'estatus',
		'class',
		'color'
	];
	
	/**
	 * Una TareaEstatus tiene muchas Tarea
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function tareas()
	{
		return $this->hasMany(Tarea::class, 'id_estatus');
	}
}
