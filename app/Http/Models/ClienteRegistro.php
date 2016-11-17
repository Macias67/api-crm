<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteRegistro extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cl_registro_clientes';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'id_cliente',
		'id_ejecutivo'
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
	 * Un ClienteRegistro pertenece a Ejecutivo
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\belongsTo
	 */
	public function ejecutivo()
	{
		return $this->belongsTo(Ejecutivo::class, 'id_ejecutivo');
	}
}
