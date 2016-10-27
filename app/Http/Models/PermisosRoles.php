<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class PermisosRoles extends Model
{
	//use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ec_permisos_roles';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'permission_id',
		'role_id'
	];
	
	public static function table()
	{
		return with(new static)->getTable();
	}
}
