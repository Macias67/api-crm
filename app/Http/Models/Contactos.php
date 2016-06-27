<?php

namespace App\App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Contactos extends Model
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
		'telefono',
		'online'
	];
	
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	public function scopeIsOnline($query)
	{
		return $query->where('online', true);
	}
}
