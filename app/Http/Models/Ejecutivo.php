<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Ejecutivo extends Authenticatable
{
	use EntrustUserTrait;
	
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
		'nombre',
		'apellido',
		'email',
		'password',
		'avatar',
		'oficina_id',
		'departamento_id',
		'online'
	];
	
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
	 * Ejecutivo tiene un Departamento
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function departamento()
	{
		return $this->belongsTo(Departamentos::class, 'departamento_id');
	}
	
	public function nombreCompleto()
	{
		return $this->nombre . ' ' . $this->apellido;
	}
}
