<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_caso';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'cliente_id',
		'estatus_id',
		'fecha_inicio',
		'fecha_tentativa_cierre',
		'fecha_termino',
		'created_at',
		'updated_at'
	];
	
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	/**
	 * Un Caso tiene un CasoLider
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function lider()
	{
		return $this->hasOne(CasoLider::class, 'caso_id');
	}
	
	/**
	 * Un Caso pertenece a un Cliente
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function cliente()
	{
		return $this->belongsTo(Clientes::class, 'cliente_id');
	}
	
	/**
	 * Un Caso pertenece a un CasoEstatus
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function estatus()
	{
		return $this->belongsTo(CasoEstatus::class, 'estatus_id');
	}
}
