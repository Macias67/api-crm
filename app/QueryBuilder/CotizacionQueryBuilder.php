<?php
/**
 * User: Luis Macias
 * Date: 26/09/2016
 * Time: 05:52 PM
 */

namespace App\QueryBuilder;

use Unlu\Laravel\Api\QueryBuilder;

class CotizacionQueryBuilder extends QueryBuilder
{
	public function filterByEstatus($query, $name)
	{
		return $query->where('estatus_id', $name);
	}
	
	public function filterByCliente($query, $name)
	{
		return $query->where('cliente_id', $name);
	}
	
	public function filterByContacto($query, $name)
	{
		return $query->where('contacto_id', $name);
	}
}