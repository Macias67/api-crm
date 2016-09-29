<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class UnidadesProductos extends Model
{
	use SyncsWithFirebase;
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
		'unidad',
	        'plural',
	        'abreviatura',
	        'online'
	];
	
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'online'    => 'boolean'
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
