<?php
/**
 * User: Luis Macias
 * Date: 22/08/2016
 * Time: 05:03 PM
 */

namespace App\QueryBuilder;

use App\Http\Models\CasoEncuesta;
use Unlu\Laravel\Api\QueryBuilder;

class CasosQueryBuilder extends QueryBuilder
{
	public function filterByLider($query, $name)
	{
		return $query->join('cs_caso_lider', 'cs_caso.id', '=', 'cs_caso_lider.caso_id')
		             ->where('cs_caso_lider.ejecutivo_lider_id', $name);
	}
	
	public function filterByRespondida($query, $name)
	{
		$this->orderBy = [
			[
				'column'    => CasoEncuesta::table() . '.id',
				'direction' => 'desc'
			]
		];
		$name = (filter_var($name, FILTER_VALIDATE_BOOLEAN)) ? 1 : 0;
		return $query->join(CasoEncuesta::table(), 'cs_caso.id', '=', CasoEncuesta::table().'.id_caso')
		             ->where(CasoEncuesta::table().'.respondida', $name);
	}
	
	public function filterByCliente($query, $name)
	{
		return $query->where('cliente_id', $name);
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