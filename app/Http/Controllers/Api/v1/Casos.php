<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Caso;
use App\Http\Models\CasoEstatus;
use App\Http\Requests\Caso\CasoReasginaRequest;
use App\QueryBuilder\CasosQueryBuilder;
use App\Transformers\CasoReasignacionTransformer;
use App\Transformers\CasoTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

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
		$queryBuilder = new CasosQueryBuilder(new Caso, $request);
		$caso = $queryBuilder->build()->get();
		
		return $this->response->collection($caso, new CasoTransformer());
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
	
	/**
	 * Reasgina el caso  a otro ejecutivo
	 *
	 * @param \App\Http\Requests\Caso\CasoReasginaRequest $request
	 * @param int                                         $idCaso
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function reasgina(CasoReasginaRequest $request, $idCaso)
	{
		$caso = Caso::find($idCaso);
		
		$reasginacion = $caso->reasignaciones()->create([
			'lider_old' => $caso->casoLider->lider->id,
			'lider_new' => $request->ejecutivo,
			'motivo'    => $request->motivo
		]);
		
		$caso->casoLider->ejecutivo_lider_id = $request->ejecutivo;
		$caso->estatus_id = CasoEstatus::REASIGNADO;
		$caso->save();
		
		/**
		 * @TODO Notifica los cambios
		 */
		
		return $this->response->item($reasginacion, new CasoReasignacionTransformer())->statusCode(201);
		
	}
}
