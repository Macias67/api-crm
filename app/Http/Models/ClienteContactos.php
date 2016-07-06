<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteContactos extends Model
{
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
		'nombre',
		'apellido',
		'email',
		'password',
		'telefono',
		'online'
	];

	protected $hidden = [
		'password'
	];
	
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
	
	public function scopeFromCliente($query, $id_cliente)
	{
		return $query->where('id_cliente', $id_cliente);
	}
	
	public function scopeIsOnline($query)
	{
		return $query->where('online', true);
	}
}
