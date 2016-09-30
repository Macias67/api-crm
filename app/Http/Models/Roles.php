<?php

namespace App\Http\Models;

use Zizaco\Entrust\EntrustRole;

class Roles extends EntrustRole
{
	use SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'ec_roles';
	
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
		'description',
		'created_at',
		'updated_at'
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
	
	/**
	 * Un Roles tiene muchos Permisos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function permisos()
	{
		return $this->belongsToMany (Permisos::class, PermisosRoles::table(), 'role_id', 'permission_id');
	}
}
