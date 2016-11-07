<?php

namespace App\Http\Models;

use App\Http\Models\Mutators\MTareaReasignacion;
use Illuminate\Database\Eloquent\Model;

class TareaReasignacion extends Model
{
	use MTareaReasignacion;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_tarea_reasignacion';
	
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
	
	/**
	 * Una TareaReasignacion pertence a Tarea
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function tarea()
	{
		return $this->belongsTo(Tarea::class, 'id_tarea');
	}
	
	/**
	 * Una TareaReasignacion pertence a Ejecutivo
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function anterior()
	{
		return $this->belongsTo(Ejecutivo::class, 'ejecutivo_old');
	}
	
	/**
	 * Una TareaReasignacion pertence a Ejecutivo
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function actual()
	{
		return $this->belongsTo(Ejecutivo::class, 'ejecutivo_new');
	}
}
