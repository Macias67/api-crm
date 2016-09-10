<?php
/**
 * User: Luis Macias
 * Date: 09/09/2016
 * Time: 08:45 PM
 */

namespace App\QueryBuilder;

use Unlu\Laravel\Api\QueryBuilder;

class EjecutivoQueryBuilder extends QueryBuilder
{
	public function filterByOnline($query, $name)
	{
		$name = (filter_var($name, FILTER_VALIDATE_BOOLEAN)) ? 1 : 0;
		
		return $query->where('online', $name);
	}
}