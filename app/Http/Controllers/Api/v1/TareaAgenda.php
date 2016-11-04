<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Tarea;
use App\Http\Models\TareaAgenda as TareaAgendaModel;
use App\Http\Requests\TareaAgendaRequest;
use App\QueryBuilder\TareaAgendaQueryBuilder;
use App\Transformers\TareaAgendaTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TareaAgenda extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, $idTarea)
	{
		//TareaAgendaModel::find($idTarea
		$queryBuilder = new TareaAgendaQueryBuilder(new TareaAgendaModel(), $request);
		$query = $queryBuilder->build()->get();
		
		return $this->response->collection($query, new TareaAgendaTransformer());
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
	 * @param \App\Http\Requests\TareaAgendaRequest $request
	 *
	 * @param int                                   $idTarea
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(TareaAgendaRequest $request, $idTarea)
	{
		
		DB::beginTransaction();
		try
		{
			$tarea = Tarea::find($idTarea);
			
			if (is_null($tarea))
			{
				return $this->response->errorNotFound('El ID de la tarea no existe.');
			}
			else
			{
				$agenda = $tarea->agenda()->create([
					'start'             => $request->get('start'),
					'end'               => $request->get('end'),
					'duracion_segundos' => $request->get('duracionSegundos'),
				]);
				
				DB::commit();
				
				return $this->response->item($agenda->fresh(), new TareaAgendaTransformer())->setStatusCode(201);
			}
		}
		catch (\Exception $e)
		{
			DB::rollback();
			
			return $this->response->error($e->getMessage(), 500);
		}
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
		//
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
