<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class CotizacionProductos extends Model
{
	use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ct_cotizacion_productos';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'id_cotizacion',
		'id_producto',
		'cantidad',
		'precio',
		'descuento',
		'subtotal',
		'iva',
		'total',
		'habilitado'
	];
	
	/**
	 * Un CotizacionProducto pertenece a una Cotizacion
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function cotizacion()
	{
		return $this->belongsTo(Cotizacion::class, 'id_cotizacion');
	}
	
	/**
	 * Un CotizacionProducto pertenece a un Producto
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function producto()
	{
		return $this->belongsTo(Productos::class, 'id_producto');
	}
	
	public function scopeIsHabilitado($query)
	{
		return $query->where('habilitado', true);
	}
	
	public static function table()
	{
		return with(new static)->getTable();
	}
}
