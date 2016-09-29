<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class NotaArchivo extends Model
{
	use SyncsWithFirebase;
	
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
	 * Una NotaArchivo pertence a Nota
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function nota()
	{
		return $this->belongsTo(Nota::class, 'id_nota');
	}
}
