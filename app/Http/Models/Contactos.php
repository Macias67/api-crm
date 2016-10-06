<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Contactos extends Model
{
	use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cl_contactos';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'id_cliente',
		'telefono'
	];
	
	/**
	 * Contacto pertenece a un UserApp
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function usuario()
	{
		return $this->belongsTo(UserApp::class, 'id');
	}
	
	/**
	 * Contacto pertenece a un Cliente
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function cliente()
	{
		return $this->belongsTo(Clientes::class, 'id_cliente');
	}
	
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	public function scopeIsOnline($query)
	{
		return $query->where('online', true);
	}
}
