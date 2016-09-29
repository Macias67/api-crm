<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Ejecutivo extends Model
{
	use SyncsWithFirebase;
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ec_ejecutivos';
	
	protected $primaryKey = 'id';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'oficina_id',
		'departamento_id',
		'color',
		'class'
	];
	
	/**
	 * Ejecutivo pertenece a un UserApp
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function userapp()
	{
		return $this->belongsTo(UserApp::class, 'id');
	}
	
	/**
	 * Ejecutivo pertenece a una Oficina
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function oficina()
	{
		return $this->belongsTo(Oficinas::class, 'oficina_id');
	}
	
	/**
	 * Un Ejecutivo tiene muchos CasoLider
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function casos()
	{
		return $this->hasMany(CasoLider::class, 'ejecutivo_lider_id');
	}
	
	/**
	 * Un Ejecutivo tiene muchos Tarea
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function tareas()
	{
		return $this->hasMany(Tarea::class, 'id_ejecutivo');
	}
	
	/**
	 * Ejecutivo tiene un Departamento
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function departamento()
	{
		return $this->belongsTo(Departamentos::class, 'departamento_id');
	}
}
