<?php
/**
 * User: Luis
 * Date: 02/11/2016
 * Time: 08:54 PM
 */

namespace App\QueryBuilder;

use App\Http\Models\Tarea;
use App\Http\Models\TareaAgenda;
use Unlu\Laravel\Api\QueryBuilder;

class TareaAgendaQueryBuilder extends QueryBuilder
{
	public function filterByNotificado($query, $name)
	{
		$name = (filter_var($name, FILTER_VALIDATE_BOOLEAN)) ? 1 : 0;
		
		return $query->where('notificado', $name);
	}
	
	public function filterByEjecutivo($query, $name)
	{
		$this->orderBy = [
			[
				'column'    => Tarea::table() . '.id',
				'direction' => 'desc'
			]
		];
		
		return $query->join(Tarea::table(), TareaAgenda::table() . '.id_tarea', '=', Tarea::table() . '.id')
		             ->where(Tarea::table() . '.id_ejecutivo', $name);
	}
}