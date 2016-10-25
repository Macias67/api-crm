<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Ejecutivo;
use App\Http\Requests\Create\AgendaRequest;
use App\Transformers\EjecutivoAgendaTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EjecutivoAgenda extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @param $idEjecutivo
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($idEjecutivo)
	{
		$ejecutivo = Ejecutivo::find($idEjecutivo);
		
		if (is_null($ejecutivo))
		{
			return $this->response->errorNotFound('El id del ejecutivo no existe.');
		}
		else
		{
			return $this->response->collection($ejecutivo->agenda, new EjecutivoAgendaTransformer());
		}
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
	 * @param \App\Http\Requests\Create\AgendaRequest $request
	 * @param                                         $idEjecutivo
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(AgendaRequest $request, $idEjecutivo)
	{
		DB::beginTransaction();
		try
		{
			$ejecutivo = Ejecutivo::find($idEjecutivo);
			
			if (is_null($ejecutivo))
			{
				return $this->response->errorNotFound('El id del ejecutivo no existe.');
			}
			else
			{
				$agenda = $ejecutivo->agenda()->create([
					'ejecutivo_id' => $idEjecutivo,
					'titulo'       => $request->get('titulo'),
					'descripcion'  => $request->get('descripcion'),
					'start'        => $request->get('start'),
					'end'          => $request->get('end'),
					'url'          => $request->get('url'),
					'referencia'   => $request->get('referencia')
				]);
				
				DB::commit();
				
				return $this->response->item($agenda, new EjecutivoAgendaTransformer())->setStatusCode(201);
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
