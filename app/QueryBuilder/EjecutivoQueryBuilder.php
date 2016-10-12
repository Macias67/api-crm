<?php
/**
 * User: Luis Macias
 * Date: 09/09/2016
 * Time: 08:45 PM
 */

namespace App\QueryBuilder;

use App\Http\Models\Ejecutivo;
use App\Http\Models\UserApp;
use Illuminate\Support\Facades\DB;
use Unlu\Laravel\Api\QueryBuilder;

class EjecutivoQueryBuilder extends QueryBuilder
{
	public function filterByOnline($query, $name)
	{
		$name = (filter_var($name, FILTER_VALIDATE_BOOLEAN)) ? 1 : 0;
		$q = $query->join(UserApp::table(), Ejecutivo::table() . '.ejecutivo_id', '=', UserApp::table() . '.id')
		           ->where(UserApp::table() . '.online', $name);
		
		return $q;
	}
}