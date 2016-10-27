<?php

namespace App\Http\Models;

use App\Http\Models\Mutators\MTarea;
use Illuminate\Database\Eloquent\Model;


class Tarea extends Model
{
	//use SyncsWithFirebase;
	use MTarea;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_tarea';
	
	protected $primaryKey = 'id';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'id_caso',
		'id_ejecutivo',
		'id_estatus',
		'titulo',
		'descripcion',
		'avance',
		'fecha_inicio',
		'fecha_tentativa_cierre',
		'fecha_cierre',
		'duracion_minutos',
		'habilitado',
	];
	
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'avance' => 'integer',
		'duracion_minutos'    => 'integer',
		'habilitado'    => 'boolean',
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
	        'fecha_tentativa_cierre',
	        'fecha_cierre'
	];
	
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	/**
	 * Una Tarea pertence a Caso
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function caso()
	{
		return $this->belongsTo(Caso::class, 'id_caso');
	}
	
	/**
	 * Una Tarea pertence a Ejecutivo
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ejecutivo()
	{
		return $this->belongsTo(Ejecutivo::class, 'id_ejecutivo');
	}
	
	/**
	 * Una Tarea pertence a TareaEstatus
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function estatus()
	{
		return $this->belongsTo(TareaEstatus::class, 'id_estatus');
	}
	
	/**
	 * Una Tarea tiene muchas Nota
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function notas()
	{
		return $this->hasMany(Nota::class, 'id_tarea');
	}
}
