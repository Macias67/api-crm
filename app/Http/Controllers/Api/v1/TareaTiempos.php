<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Tarea;
use App\Http\Requests\Create\TareaTiemposRequest;
use App\Transformers\TareaTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TareaTiempos extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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
	 * @param \App\Http\Requests\Create\TareaTiemposRequest $request
	 * @param int                                           $idTarea
	 *
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(TareaTiemposRequest $request, $idTarea)
	{
		DB::beginTransaction();
		try
		{
			$tarea = Tarea::find($idTarea);
			
			if (is_null($tarea))
			{
				return $this->response->errorNotFound('El id del la tarea no existe.');
			}
			else
			{
				$tarea->tiempos()->create([
					'fecha_inicio'      => $request->get('inicio'),
					'fecha_fin'         => $request->get('fin'),
					'duracion_segundos' => $request->get('duracion')
				]);
				
				$tarea->duracion_real_segundos += $request->get('duracion');
				$tarea->save();
				
				DB::commit();
				
				return $this->response->item($tarea->fresh(), new TareaTransformer());
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
	 * @param  int                      $idTarea
	 * @param  int                      $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $idTarea, $id)
	{
		$tarea = Tarea::find($idTarea);
		$tiempo = $tarea->tiempos()->where('id', $id)->get()->first();
		
		$tareaSegundos = $tarea->duracion_real_segundos - $tiempo->duracion_segundos;
		$tarea->duracion_real_segundos = $tareaSegundos + $request->duracionSegundos;
		
		$tiempo->fecha_inicio = $request->fechaInicio;
		$tiempo->duracion_segundos = $request->duracionSegundos;
		$tiempo->fecha_fin = $request->fechaFin;
		
		$tarea->save();
		$tiempo->save();
		
		return $this->response->noContent();
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
