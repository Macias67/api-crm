<?php
/**
 * User: Luis Macias
 * Date: 12/10/2016
 * Time: 02:20 PM
 */

namespace App\Http\Models\Mutators;


trait MTarea
{
	/**
	 * Establece el título de la terea.
	 *
	 * @param  string $value
	 *
	 * @return void
	 */
	public function setTituloAttribute($value)
	{
		$titulo = ucfirst($value);
		$titulo = (ends_with($titulo, '.') ? $titulo : $titulo . '.');
		
		$this->attributes['titulo'] = $titulo;
	}
	
	/**
	 * Establece el título de la terea.
	 *
	 * @param  string $value
	 *
	 * @return void
	 */
	public function setDescripcionAttribute($value)
	{
		$descripcion = ucfirst($value);
		$descripcion = (ends_with($descripcion, '.') ? $descripcion : $descripcion . '.');
		
		$this->attributes['descripcion'] = $descripcion;
	}
}