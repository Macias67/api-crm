<?php
/**
 * User: Luis Macias
 * Date: 22/08/2016
 * Time: 05:03 PM
 */

namespace App\QueryBuilder;

use Unlu\Laravel\Api\QueryBuilder;

class CasosQueryBuilder extends QueryBuilder
{
	public function filterByLider($query, $name)
	{
		return $query->join('cs_caso_lider', 'cs_caso.id', '=', 'cs_caso_lider.caso_id')
		             ->where('cs_caso_lider.ejecutivo_lider_id', $name);
	}
	
	public function filterByEstatus($query, $name)
	{
		return $query->where('estatus_id', $name);
	}
	
	public function filterByRegistro($query, $name)
	{
		return $query->where('created_at', $name);
	}
}