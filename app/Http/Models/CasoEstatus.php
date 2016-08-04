<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CasoEstatus extends Model
{
	const PORASIGNAR = 1;
	const REASIGNADO = 2;
	const PROCESO    = 3;
	const PRECIERRE  = 4;
	const CERRADO    = 5;
	const SUSPENDIDO = 6;
	const CANCELADO  = 7;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_caso_estatus';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'estatus',
		'class',
		'color'
	];
	
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	/**
	 * Un CasoEstatus tiene muchos Casos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function casos()
	{
		return $this->hasMany(Caso::class, 'estatus_id');
	}
}
