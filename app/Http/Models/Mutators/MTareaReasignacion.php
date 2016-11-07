<?php
/**
 * User: Luis
 * Date: 06/11/2016
 * Time: 03:47 PM
 */

namespace App\Http\Models\Mutators;


trait MTareaReasignacion
{
	/**
	 * Establece el título de la terea.
	 *
	 * @param  string $value
	 *
	 * @return void
	 */
	public function setMotivoAttribute($value)
	{
		$descripcion = ucfirst($value);
		$descripcion = (ends_with($descripcion, '.') ? $descripcion : $descripcion . '.');
		
		$this->attributes['motivo'] = $descripcion;
	}
}