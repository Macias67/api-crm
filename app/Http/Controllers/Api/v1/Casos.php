<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Caso;
use App\Transformers\CasoTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;

class Casos extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$queryBuilder = new QueryBuilder(new Caso, $request);
		
		return response()->json([
			'data' => $queryBuilder->build()->get(),
		]);
		
		//return $this->response->collection($queryBuilder->get(), new CasoTransformer());

//		$param = Input::all();
//
//		if (array_key_exists('asignado', $param))
//		{
//			$casos = Caso::isAsignado($param['asignado'])->get();
//
//			return $this->response->collection($casos, new CasoTransformer());
//		}
//		elseif (array_key_exists('lider', $param))
//		{
//			$casoLider = CasoLider::where('ejecutivo_lider_id', $param['lider'])->get();
//
//			//$ejecutivo = Ejecutivo::find($param['lider']);
//			//$casos = Caso::isAsignado(true)->casoLider()->where('ejecutivo_lider_id', $param['lider'])->get();
//			//dd($casos[0]->caso);
//
//			$casos = [];
//			foreach ($casoLider as $index => $caso)
//			{
//				array_push($casos, $caso->caso);
//			}
//			$collection = collect($casos)->where('estatus_id', (int)$param['estatus']);
//
//			return $this->response->collection($collection, new CasoTransformer());
//		}
//		else
//		{
//			$casos = Caso::all();
//
//			return $this->response->collection($casos, new CasoTransformer());
//		}
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$caso = Caso::find($id);
		
		if (is_null($caso))
		{
			return $this->response->errorNotFound('El ID del caso no existe.');
		}
		else
		{
			return $this->response->item($caso, new CasoTransformer());
		}
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
