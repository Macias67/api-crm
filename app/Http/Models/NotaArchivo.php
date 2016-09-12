<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class NotaArchivo extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cs_nota_archivo';
	
	protected $primaryKey = 'id';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'id_nota',
		'archivo',
		'nombre',
		'extension'
	];
	
	public static function table()
	{
		return with(new static)->getTable();
	}
	
	/**
	 * Una NotaArchivo pertence a Nota
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function nota()
	{
		return $this->belongsTo(Nota::class, 'id_nota');
	}
}
