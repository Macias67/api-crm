<?php

namespace App\Http\Models;

use App\Http\Models\Mutators\UserAppMutator;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class UserApp extends Authenticatable
{
	// @TODO cada vez que se haga un db:seed comentar esta linea
	//use EntrustUserTrait;
	use UserAppMutator, SyncsWithFirebase;
	
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'usr_usuarios';
	
	protected $primaryKey = 'id';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'nombre',
		'apellido',
		'ejecutivo',
		'avatar',
		'online',
		'email',
		'password',
		'created_at',
		'updated_at'
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];
	
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'ejecutivo' => 'boolean',
		'online'    => 'boolean'
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
	 * Un UserApp tiene muchos Roles
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function roles()
	{
		return $this->belongsToMany(Roles::class, RolesUser::table(), 'user_id', 'role_id');
	}
	
	/**
	 * Un UserApp tiene un Ejecutivo
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function infoEjecutivo()
	{
		return $this->hasOne(Ejecutivo::class, 'id');
	}
	
	/**
	 * Un UserApp tiene un Contacto
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function infoContacto()
	{
		return $this->hasOne(Contactos::class, 'id');
	}
	
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	public function nombreCompleto()
	{
		return $this->nombre . ' ' . $this->apellido;
	}
}
