<?php
/**
 * User: Luis
 * Date: 02/11/2016
 * Time: 08:54 PM
 */

namespace App\QueryBuilder;

use Unlu\Laravel\Api\QueryBuilder;

class TareaAgendaQueryBuilder extends QueryBuilder
{
	public function filterByNotificado($query, $name)
	{
		$name = (filter_var($name, FILTER_VALIDATE_BOOLEAN)) ? 1 : 0;
		
		return $query->where('notificado', $name);
	}
}