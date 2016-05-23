<?php

namespace App\Http\Models;

use Zizaco\Entrust\EntrustPermission;

class Permisos extends EntrustPermission
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ec_permisos';
	
	protected $primaryKey = 'id';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'name',
		'display_name',
		'description'
	];
}
