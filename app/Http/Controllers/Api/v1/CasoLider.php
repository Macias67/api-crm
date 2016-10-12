<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\NotificaUsuario;
use App\Http\Controllers\Controller;
use App\Http\Models\Caso;
use App\Http\Models\CasoEstatus;
use App\Http\Models\FBNotification;
use App\Transformers\CasoLiderTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CasoLider extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($idCaso)
	{
		$caso = Caso::find($idCaso);
		
		if (is_null($caso))
		{
			return $this->response->errorNotFound('El id del caso no existe.');
		}
		elseif (is_null($caso->casoLider))
		{
			return $this->response->errorNotFound('El caso no tiene líder.');
		}
		else
		{
			//dd($caso->casoLider);
			return $this->response->item($caso->casoLider, new CasoLiderTransformer());
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
	 * @TODO Hacer un request que revise que el lider sí es ejecutivo
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(Request $request, $idCaso)
	{
		try
		{
			$caso = Caso::find($idCaso);
			
			DB::beginTransaction();
			
			$caso->casoLider()->create([
				'ejecutivo_lider_id' => $request->get('lider')
			]);
			
			$caso->asignado = true;
			$caso->estatus_id = CasoEstatus::ASIGNADO;
			$caso->save();
			
			DB::commit();
			
			/**
			 * @TODO Enviar correo al cliente y ejecutivo de asignacion de caso y notificar en la app.
			 */
			$notificacion = new FBNotification('Se te ha asignado nuevo caso.');
			$notificacion->setMensaje('Ahora eres líder del caso #' . $caso->id . ' del cliente ' . $caso->cliente->razonsocial . '.')
			             ->setTipo(FBNotification::INFO);
			
			event(new NotificaUsuario($notificacion));
			
			return $this->response->item($caso->casoLider, new CasoLiderTransformer());
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
	public function show($idCaso)
	{
		dd($idCaso);
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
