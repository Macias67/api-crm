<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CasoLider extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_caso_lider';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'caso_id',
		'ejecutivo_id',
		'created_at',
		'updated_at'
	];
	
	/**
	 * Un CasoLider tiene un Caso
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function caso()
	{
		return $this->hasOne(Caso::class, 'id');
	}
	
	/**
	 * Un CasoLider pertenece a Ejecutivo
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function lider()
	{
		return $this->belongsTo(Ejecutivo::class, 'id');
	}
	
	public static function table()
	{
		return with(new static)->getTable();
	}
}
