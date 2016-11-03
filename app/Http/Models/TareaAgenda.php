<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TareaAgenda extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_tarea_agenda';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'id_tarea',
		'start',
		'end',
		'duracion_segundos',
		'notificado',
		'created_at',
		'updated_at'
	];
	
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'duracion_segundos' => 'integer',
		'notificado'        => 'boolean',
	];
	
	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'start',
		'end',
		'created_at',
		'updated_at'
	];
	
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	/**
	 * Una Agenda  pertenece a un Ejecutivo
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function tarea()
	{
		return $this->belongsTo(Tarea::class, 'id_tarea');
	}
}
