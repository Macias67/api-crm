<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Tarea;
use App\Http\Models\TareaEstatus;
use App\Http\Requests\Create\NotaRequest;
use App\Transformers\TareaTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TareaNotas extends Controller
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
	 * @param \App\Http\Requests\Create\NotaRequest|\Illuminate\Http\Request $request
	 *
	 * @param                                                                $idTarea
	 *
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(NotaRequest $request, $idTarea)
	{
		try
		{
			$tarea = Tarea::find($idTarea);

			DB::beginTransaction();

			$tarea->notas()->create([
				'nota'       => $request->get('descripcion'),
				'publico'    => (bool)$request->get('tipo'),
				'habilitado' => true,
			]);

			/**
			 * Si empieza a asignar tareas, cambio el estatus del caso y registro fecha de inicio
			 */
			if ($tarea->id_estatus == TareaEstatus::ASIGNADO)
			{
				$tarea->id_estatus = TareaEstatus::PROCESO;
				$tarea->save();
			}

			DB::commit();

			return $this->response->item($tarea, new TareaTransformer());
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
