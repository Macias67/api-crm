<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Tarea;
use App\Http\Models\TareaEstatus;
use App\Http\Requests\Tarea\TareaCambiaEstatusRequest;
use App\Http\Requests\Tarea\TareaReasginaRequest;
use App\Http\Requests\TareaRequest;
use App\Http\Requests\Update\TareaEstableceFechaRequest;
use App\Http\Requests\Update\TareaUpdateRequest;
use App\QueryBuilder\TareaQueryBuilder;
use App\Transformers\TareaReasignacionTransformer;
use App\Transformers\TareaTransformer;
use Carbon\Carbon;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Tareas extends Controller
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
		$queryBuilder = new TareaQueryBuilder(new Tarea(), $request);
		
		return $this->response->collection($queryBuilder->build()->get(), new TareaTransformer());
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
		$tarea = Tarea::find($id);
		
		if (is_null($tarea))
		{
			return $this->response->errorNotFound('El ID de la tarea no existe.');
		}
		else
		{
			return $this->response->item($tarea, new TareaTransformer());
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
	 * @param \App\Http\Requests\TareaRequest $request
	 * @param  int                            $idTarea
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(TareaRequest $request, $idTarea)
	{
		$tarea = Tarea::find($idTarea);
		$tarea->id_estatus = $request->estatus;
		$tarea->titulo = $request->titulo;
		$tarea->descripcion = $request->descripcion;
		$tarea->avance = $request->avance;
		
		$tarea->fecha_inicio = $request->fechainicio;
		$tarea->fecha_tentativa_cierre = $request->fechatentativacierre;
		$tarea->duracion_tentativa_segundos = $request->duracionsegundos;
		$tarea->save();
		
		$tarea = $tarea->fresh();
		/**
		 * @TODO Calcular las fechas de todas las tareas y establecer fecha tentativa de cierre del caso
		 */
		$tareasActivas = $tarea->caso->tareas()->activas();
		if ($tareasActivas->where('fecha_tentativa_cierre', '<>', null)->count() == $tareasActivas->count())
		{
			$fechaPrecierreAnterior = Carbon::createFromFormat('Y-m-d H:i:s', $tarea->caso->fecha_tentativa_precierre)->timestamp;
			$fechaCierre = $tareasActivas->get()->max('fecha_tentativa_cierre')->format('Y-m-d H:i:s');
			$nuevaFechaCierre = Carbon::createFromFormat('Y-m-d H:i:s', $fechaCierre)->timestamp;
			
			$tarea->caso->fecha_tentativa_precierre = $fechaCierre;
			$tarea->caso->save();
			
			/**
			 * @TODO SI la fecha ha cambiado, enviar notificacion y correo al cliente e involucrados al caso avisando el cambio
			 */
			if ($fechaPrecierreAnterior != $nuevaFechaCierre)
			{
				
			}
		}
		
		return $this->response->item($tarea, new TareaTransformer());
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
	 * @param \App\Http\Requests\Update\TareaEstableceFechaRequest $request
	 * @param int                                                  $id
	 *
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function asignaFechas(TareaEstableceFechaRequest $request, $id)
	{
		$tarea = Tarea::find($id);
		
		if (is_null($tarea))
		{
			return $this->response->errorNotFound('El ID de la tarea no existe.');
		}
		else
		{
			try
			{
				DB::beginTransaction();
				
				$tarea->fecha_inicio = $request->get('fechainicio');
				$tarea->fecha_tentativa_cierre = $request->get('fechatentativacierre');
				$tarea->duracion_tentativa_segundos = $request->get('duraciontentativasegundos');
				$tarea->save();
				
				/**
				 * @TODO Calcular las fechas de todas las tareas y establecer fecha tentativa de cierre del caso
				 */
				$tareasActivas = $tarea->caso->tareas()->activas();
				if ($tareasActivas->where('fecha_tentativa_cierre', '<>', null)->count() == $tareasActivas->count())
				{
					$tarea->caso->fecha_tentativa_precierre = $tareasActivas->get()->max('fecha_tentativa_cierre')->format('Y-m-d H:i:s');
					$tarea->caso->save();
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
	}
	
	
	/**
	 * Reasgina la tarea a otro ejecutivo
	 *
	 * @param \App\Http\Requests\Tarea\TareaReasginaRequest $request
	 * @param int                                           $idTarea
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function reasgina(TareaReasginaRequest $request, $idTarea)
	{
		$tarea = Tarea::find($idTarea);
		
		$reasginacion = $tarea->reasignaciones()->create([
			'ejecutivo_old' => $tarea->ejecutivo->id,
			'ejecutivo_new' => $request->ejecutivo,
			'motivo'        => $request->motivo
		]);
		
		$tarea->id_ejecutivo = $request->ejecutivo;
		$tarea->id_estatus = TareaEstatus::REASIGNADO;
		$tarea->save();
		
		/**
		 * @TODO Notifica los cambios
		 */
		
		return $this->response->item($reasginacion, new TareaReasignacionTransformer())->statusCode(201);
	}
	
	/**
	 * Cambia el estatus de la tarea
	 *
	 * @param \App\Http\Requests\Tarea\TareaCambiaEstatusRequest $request
	 * @param int                                                $idTarea
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function cambiaEstatus(TareaCambiaEstatusRequest $request, $idTarea)
	{
		$tarea = Tarea::find($idTarea);
		$tarea->id_estatus = $request->estatus;
		$tarea->save();
		
		return $this->response->item($tarea, new TareaTransformer())->statusCode(201);
	}
}
