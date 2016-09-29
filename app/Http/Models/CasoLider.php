<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class CasoLider extends Model
{
	use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_caso_lider';
	
	protected $primaryKey = 'caso_id';
	
	protected $fillable = [
		'caso_id',
		'ejecutivo_lider_id',
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
		return $this->belongsTo(Ejecutivo::class, 'ejecutivo_lider_id');
	}
	
	/**
	 * Un CasoLider pertenece a Ejecutivo
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function asignadopor()
	{
		return $this->belongsTo(Ejecutivo::class, 'ejecutivo_asigna_id');
	}
	
	public static function table()
	{
		return with(new static)->getTable();
	}
}
