<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
	//use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ct_cotizacion';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'cliente_id',
		'ejecutivo_id',
		'contacto_id',
		'oficina_id',
		'estatus_id',
		'vencimiento',
		'cxc',
		'subtotal',
		'iva',
		'total',
		'created_at',
		'updated_at'
	];
	
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'vencimiento' => 'date',
		'cxc'         => 'boolean',
		'subtotal'    => 'float',
		'iva'         => 'float',
		'total'       => 'float'
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
	 * Un Cotizacion pertenece a una Cliente
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function cliente()
	{
		return $this->belongsTo(Clientes::class, 'cliente_id');
	}
	
	/**
	 * Un Cotizacion pertenece a una CotizacionEstatus
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function estatus()
	{
		return $this->belongsTo(CotizacionEstatus::class, 'estatus_id');
	}
	
	/**
	 * Un Cotizacion pertenece a un Ejecutivo
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function ejecutivo()
	{
		return $this->belongsTo(Ejecutivo::class, 'ejecutivo_id');
	}
	
	/**
	 * Un Cotizacion pertenece a un Contacto
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function contacto()
	{
		return $this->belongsTo(Contactos::class, 'contacto_id');
	}
	
	/**
	 * Un Cotizacion pertenece a una Oficina
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function oficina()
	{
		return $this->belongsTo(Oficinas::class, 'oficina_id');
	}
	
	/**
	 * Una Cotizacion tiene muchos productos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function productos()
	{
		return $this->hasMany(CotizacionProductos::class, 'id_cotizacion');
	}
	
	/**
	 * Una Cotizacion tiene muchos bancos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function bancos()
	{
		return $this->hasMany(CotizacionBancos::class, 'id_cotizacion');
	}
	
	/**
	 * Una Cotizacion tiene muchos pagos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function pagos()
	{
		return $this->hasMany(CotizacionPagos::class, 'cotizacion_id');
	}
	
	/**
	 * Una Cotizacion tiene muchos CasoCotizacion
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function casos()
	{
		return $this->hasMany(CasoCotizacion::class, 'cotizacion_id');
	}
}
