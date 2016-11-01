<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TareaTiempos extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_tarea_tiempos';
	
	protected $primaryKey = 'id';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'id_tarea',
		'fecha_inicio',
		'fecha_fin',
		'duracion_segundos',
		'created_at',
		'updated_at',
	];
	
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'duracion_segundos' => 'integer'
	];
	
	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'fecha_inicio',
		'fecha_fin',
	];
	
	/**
	 * Método para tener el nombre de la tabla con un método estatico.
	 * @return mixed
	 */
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	/**
	 * Una TareaTiempos pertence a Tarea
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function tarea()
	{
		return $this->belongsTo(Tarea::class, 'id_tarea');
	}
}
