<?php
/**
 * User: Luis Macias
 * Date: 19/10/2016
 * Time: 04:53 PM
 */

namespace App\QueryBuilder;

use Unlu\Laravel\Api\QueryBuilder;

class AgendaQueryBuilder extends QueryBuilder
{
	public function filterByEjecutivo($query, $name)
	{
		return $query->where('ejecutivo_id', $name);
	}
	
	public function filterByNotificado($query, $name)
	{
		$name = (filter_var($name, FILTER_VALIDATE_BOOLEAN)) ? 1 : 0;
		return $query->where('notificado', $name);
	}
	
	public function filterByReferencia($query, $name)
	{
		return $query->where('referencia', $name);
	}
}