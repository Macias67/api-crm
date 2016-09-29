<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class Nota extends Model
{
	use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_nota';
	
	protected $primaryKey = 'id';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'id_tarea',
		'nota',
		'publico',
		'habilitado',
	];
	
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'publico' => 'boolean',
		'habilitado'    => 'boolean'
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
	 * Una Nota pertence a Tarea
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function tarea()
	{
		return $this->belongsTo(Tarea::class, 'id_tarea');
	}
	
	/**
	 * Una Nota tiene muchos NotaArchivo
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function archivos()
	{
		return $this->hasMany(NotaArchivo::class, 'id_nota');
	}
}
