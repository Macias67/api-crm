<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
	//use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ag_agenda';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'ejecutivo_id',
		'titulo',
		'descripcion',
		'allDay',
		'start',
		'end',
		'duracion_segundos',
		'url',
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
		'allDay'            => 'boolean',
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
	public function ejecutivo()
	{
		return $this->belongsTo(Ejecutivo::class, 'ejecutivo_id');
	}
}