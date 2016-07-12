<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadesProductos extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ec_unidad_productos';
	
	protected $primaryKey = 'id';
	
	public $timestamps = false;
	
	protected $fillable = [
		'id',
		'unidad'
	];

	/**
	 * Unidad pertenece a un Producto
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function productos()
	{
		return $this->hasMany(Productos::class, 'id_unidad');
	}
}
