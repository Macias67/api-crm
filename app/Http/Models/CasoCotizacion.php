<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CasoCotizacion extends Model
{
	use SyncsWithFirebase;
	
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
		'fecha_validacion',
		'created_at',
		'updated_at'
	];
	
	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'fecha_validacion',
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
	
	/**
	 * Un CasoCotizacion pertence a una Cotizacion
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cotizacion()
	{
		return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
	}
	
	
	public static function table()
	{
		return with(new static)->getTable();
	}
}
