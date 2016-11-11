<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Caso;
use App\Http\Models\CasoEstatus;
use App\Http\Models\TareaEstatus;
use App\Http\Requests\TareaRequest;
use App\Transformers\CasoTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CasoTareas extends Controller
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
	 * @param \App\Http\Requests\TareaRequest $request
	 * @param                                        $idCaso
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(TareaRequest $request, $idCaso)
	{
		try
		{
			$caso = Caso::find($idCaso);
			
			DB::beginTransaction();
			
			 $caso->tareas()->create([
				'id_ejecutivo' => $request->get('ejecutivo'),
				'id_estatus'   => TareaEstatus::ASIGNADO,
				'titulo'       => $request->get('titulo'),
				'descripcion'  => $request->get('descripcion'),
			]);
			
			/**
			 * Si empieza a asignar tareas, cambio el estatus del caso y registro fecha de inicio
			 */
			if ($caso->estatus_id == CasoEstatus::ASIGNADO)
			{
				$caso->estatus_id = CasoEstatus::PROCESO;
				$caso->fecha_inicio = date('Y-m-d H:i:s', time());
				$caso->save();
			}
			
			DB::commit();
			
			/**
			 * @TODO Enviar correo al ejecutivo de asignacion de tarea y notificar en la app.
			 */
				
			return $this->response->item($caso, new CasoTransformer());
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
