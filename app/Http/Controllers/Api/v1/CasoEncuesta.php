<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Caso;
use App\Http\Models\CasoEstatus;
use App\Http\Models\CotizacionEstatus;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class CasoEncuesta extends Controller
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
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, $idCaso)
	{
		$caso = Caso::find($idCaso);
		$caso->encuesta()->update([
			'id_contacto'     => $request->user()->id,
			'respondida'      => true,
			'respuestas_json' => json_encode($request->encuesta),
			'puntaje'         => $request->puntaje,
		]);
		
		if ($caso->casoCotizacion->cotizacion->cxc)
		{
			if ($request->puntaje >= 80)
			{
				$caso->estatus_id = CasoEstatus::CERRADO;
				$caso->fecha_cierre = date('Y-m-d H:i:s');
			}
			
			return $this->response->noContent();
		}
		else
		{
			if ($request->puntaje >= 80)
			{
				if ($caso->casoCotizacion->cotizacion->estatus_id == CotizacionEstatus::PAGADA)
				{
					$caso->estatus_id = CasoEstatus::CERRADO;
					$caso->fecha_cierre = date('Y-m-d H:i:s');
					$caso->save();
					
					return $this->response->noContent();
				}
				else
				{
					$meta = [
						'msg' => 'La cotización no ha sido pagada'
					];
					
					return $this->response->noContent()->setMeta($meta);
				}
				
			}
			else
			{
				return $this->response->noContent();
			}
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
