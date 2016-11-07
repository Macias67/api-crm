<?php
/**
 * User: Luis Macias
 * Date: 12/09/2016
 * Time: 09:15 PM
 */

namespace App\QueryBuilder;


use Unlu\Laravel\Api\QueryBuilder;

class TareaQueryBuilder extends QueryBuilder
{
	public function filterByCaso($query, $name)
	{
		return $query->where('id_caso', $name);
	}
	
	public function filterByEjecutivo($query, $name)
	{
		return $query->where('id_ejecutivo', $name);
	}
	
	public function filterByEstatus($query, $name)
	{
		return $query->orWhere('id_estatus', $name);
	}
}