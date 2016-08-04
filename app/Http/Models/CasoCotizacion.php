<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CasoCotizacion extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_caso_cotizacion';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'caso_id',
		'cotizacion_id',
		'created_at',
		'updated_at'
	];
	
	/**
	 * Un CasoCotizacion pertence a Caso
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function caso()
	{
		return $this->belongsTo(Caso::class, 'caso_id');
	}
	
	
	public static function table()
	{
		return with(new static)->getTable();
	}
}
