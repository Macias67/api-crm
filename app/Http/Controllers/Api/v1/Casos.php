<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Caso;
use App\Http\Models\CasoEstatus;
use App\Http\Models\Tarea;
use App\Http\Models\TareaEstatus;
use App\Http\Requests\Caso\CasoReasginaRequest;
use App\Http\Requests\Caso\CasoReasignacionRequest;
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
	public function reasigna(CasoReasginaRequest $request, $idCaso)
	{
		$caso = Caso::find($idCaso);
		$reasginacion = $caso->reasignaciones()->create([
			'lider_old' => $caso->casoLider->lider->id,
			'lider_new' => $request->ejecutivo,
			'motivo'    => $request->motivo
		]);
		
		$caso->casoLider->ejecutivo_lider_id = $request->ejecutivo;
		$caso->estatus_id = CasoEstatus::REASIGNADO;
		
		$caso->casoLider->save();
		$caso->save();
		
		/**
		 * @TODO Notifica los cambios
		 */
		
		return $this->response->item($reasginacion, new CasoReasignacionTransformer())->statusCode(201);
	}
	
	/**
	 * Cambia el estatus del Caso
	 *
	 * @param \App\Http\Requests\Caso\CasoReasignacionRequest $request
	 * @param int                                             $idCaso
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function cambiaEstatus(CasoReasignacionRequest $request, $idCaso)
	{
		$caso = Caso::find($idCaso);
		$caso->estatus_id = $request->estatus;
		
		//Cambios en tarea
		switch ($caso->estatus_id)
		{
			case CasoEstatus::PRECIERRE:
			case CasoEstatus::CERRADO:
				// Las tareas se cierran al 100%
				Tarea::activas()
				     ->where('id_caso', $caso->id)
				     ->where(function ($query)
				     {
					     $query
						     ->where('id_estatus', '<>', TareaEstatus::CERRADO)
						     ->orWhere('avance', '<>', 100);
				     })
				     ->update([
					     'id_estatus'   => TareaEstatus::CERRADO,
					     'avance'       => 100,
					     'fecha_cierre' => date('Y-m-d H:i:s'),
				     ]);
				
				$caso->avance = 100;
				$caso->fecha_precierre = date('Y-m-d H:i:s');
				
				if ($caso->estatus_id == CasoEstatus::PRECIERRE)
				{
					/**
					 * @TODO Notifica a los ejecutivos que las tareas fueron cerradas y crea encuesta
					 */
				}
				elseif ($caso->estatus_id == CasoEstatus::CERRADO)
				{
					$caso->fecha_cierre = date('Y-m-d H:i:s');
					
					/**
					 * @TODO Notifica a los ejecutivos que las tareas fueron cerradas
					 */
				}
				break;
			case CasoEstatus::SUSPENDIDO:
				/**
				 * @TODO Notifica a los ejecutivos y cliente que el caso fue suspendido
				 */
				break;
			case CasoEstatus::CANCELADO:
				/**
				 * @TODO Notifica a los ejecutivos y cliente que el caso fue cancelado
				 */
				break;
		}
		
		$caso->save();
		
		return $this->response->item($caso->fresh(), new CasoTransformer())->statusCode(201);
	}
}
