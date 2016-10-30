<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioTokens extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'usr_usuario_tokens';
	
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'id_usuario',
		'token',
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
	 * Nombre de la tabla
	 *
	 * @return mixed
	 */
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	/**
	 * Un UsuarioToken pertenece a un Usuario
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function usuario()
	{
		return $this->belongsTo(UserApp::class, 'id_usuario');
	}
}
