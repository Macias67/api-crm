<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\NotificaUsuario;
use App\Http\Controllers\Controller;
use App\Http\Models\CasoEstatus;
use App\Http\Models\FBNotification;
use App\Http\Models\Nota;
use App\Http\Models\Tarea;
use App\Http\Models\TareaEstatus;
use App\Http\Requests\NotaRequest;
use App\Transformers\NotaTransformer;
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
	public function index($idTarea)
	{
		$tarea = Tarea::find($idTarea);
		
		if (is_null($tarea))
		{
			return $this->response->errorNotFound('El id de la tarea no existe.');
		}
		else
		{
			dd($tarea->notas);
			//return $this->response->item($caso->casoLider, new CasoLiderTransformer());
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
	 * @param \App\Http\Requests\Create\NotaRequest                          $request
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
			
			$tarea->avance = $request->get('avance');
			$tarea->save();
			
			$nota = $tarea->notas()->create([
				'nota'       => $request->get('descripcion'),
				'publico'    => (bool)$request->get('tipo'),
				'avance'     => $request->get('avance'),
				'habilitado' => true,
			]);
			
			if ($request->has('archivo'))
			{
				$archivo = $request->get('archivo');
				$nota->archivos()->create([
					'download_url' => $archivo['url'],
					'content_type' => $archivo['contentType'],
					'full_path'    => $archivo['fullPath'],
					'md5hash'      => $archivo['hash'],
					'name'         => $archivo['name'],
					'size'         => $archivo['size']
				]);
			}
			
			/**
			 * Si empieza a crear notas, cambio el estatus de la tarea y registro fecha de inicio de tarea
			 */
			$estatus = [TareaEstatus::ASIGNADO, TareaEstatus::REASIGNADO, TareaEstatus::PROCESO, TareaEstatus::SUSPENDIDO];
			if (in_array($tarea->id_estatus, $estatus))
			{
				if ($tarea->avance < 100)
				{
					$tareas = $tarea->caso->tareas;
					
					$tarea->id_estatus = TareaEstatus::PROCESO;
					$tarea->caso->avance = (int)($tareas->sum('avance') / $tareas->count());
					
					$tarea->caso->save();
					$tarea->save();
				}
				else if ($tarea->avance == 100)
				{
					$tarea->id_estatus = TareaEstatus::CERRADO;
					$tarea->fecha_cierre = date('Y-m-d H:i:s');
					$tarea->save();
					
					/**
					 * Reviso todas las tareas del caso que esten cerradas, si es asi PRECIERRO el caso y
					 * mando las notificaciones
					 */
					$tareas = $tarea->caso->tareas;
					if ($tareas->count() == $tareas->where('id_estatus', TareaEstatus::CERRADO)->count())
					{
						$tarea->caso->estatus_id = CasoEstatus::PRECIERRE;
						$tarea->caso->fecha_termino = date('Y-m-d H:i:s');
						$tarea->caso->avance = (int)($tareas->sum('avance') / $tareas->count());
						$tarea->caso->save();
						
						/**
						 * @TODO Envia email y notificación
						 */
						$notificacion = new FBNotification('Caso #' . $tarea->caso->id . ' ahora está en Precierre.');
						$notificacion
							->setMensaje('Se han cerrado todas las tareas del caso #' . $tarea->caso->id . ', en espera de que ' . $tarea->caso->cliente->razonsocial . ' conteste la encuesta para su cierre.')
							->setTipo(FBNotification::SUCCESS);
						
						event(new NotificaUsuario($notificacion));
						
						$tarea->save();
					}
				}
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
	public function update(NotaRequest $request, $idTarea, $idNota)
	{
		try
		{
			$nota = Nota::find($idNota);
			
			DB::beginTransaction();
			
			$nota->avance = $request->get('avance');
			$nota->nota = $request->get('nota');
			$nota->publico = $request->get('publico');
			$nota->save();
			
			DB::commit();
			
			return $this->response->item($nota, new NotaTransformer());
		}
		catch (\Exception $e)
		{
			DB::rollback();
			
			return $this->response->error($e->getMessage(), 500);
		}
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $idTarea
	 * @param  int $idNota
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($idTarea, $idNota)
	{
		$tarea = Tarea::find($idTarea);
		
		if (is_null($tarea))
		{
			return $this->response->errorNotFound('El ID de la tarea no existe.');
		}
		else
		{
			$nota = $tarea->notas->where('id', (int)$idNota);
			if (!$nota->isEmpty())
			{
				$nota->first()->delete();
				
				return $this->response->noContent();
			}
			else
			{
				return $this->response->errorNotFound('El ID de la nota no existe.');
			}
		}
	}
}
