<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CasoEstatus extends Model
{
	use SyncsWithFirebase;
	
	const PORASIGNAR = 1;
	const ASIGNADO   = 2;
	const REASIGNADO = 3;
	const PROCESO    = 4;
	const PRECIERRE  = 5;
	const CERRADO    = 6;
	const SUSPENDIDO = 7;
	const CANCELADO  = 8;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_caso_estatus';
	
	protected $primaryKey = 'id';
	
	public $timestamps = false;
	
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
