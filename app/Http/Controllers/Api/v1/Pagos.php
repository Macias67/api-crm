<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Caso;
use App\Http\Models\CasoEstatus;
use App\Http\Models\Cotizacion  as CotizacionModel;;
use App\Http\Models\CotizacionEstatus;
use App\Transformers\CotizacionPagosTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class Pagos extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @param $idCotizacion
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($idCotizacion)
	{
		$cotizacion = CotizacionModel::find($idCotizacion);
		
		if (is_null($cotizacion))
		{
			return $this->response->errorNotFound('El folio de la cotización no existe.');
		}
		else
		{
			return $this->response->collection($cotizacion->pagos, new CotizacionPagosTransformer());
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
	 * @param  int $idCotizacion
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($idCotizacion, $id)
	{
		$cotizacion = CotizacionModel::find($idCotizacion);
		
		if (is_null($cotizacion))
		{
			return $this->response->errorNotFound('El folio de la cotización no existe.');
		}
		else
		{
			$pago = $cotizacion->pagos()->find($id);
			
			if (is_null($pago))
			{
				return $this->response->errorNotFound('El ID del pago no corresponde a la cotización.');
			}
			else
			{
				return $this->response->item($pago, new CotizacionPagosTransformer());
			}
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
	 * @TODO Hacer un request para validar que el usuario puede validar el pago
	 *
	 * @return \Dingo\Api\Dispatcher
	 */
	public function validaPago(Request $request, $idCotizacion, $id)
	{
		$cotizacion = CotizacionModel::find($idCotizacion);
		
		if (is_null($cotizacion))
		{
			return $this->response->errorNotFound('El folio de la cotización no existe.');
		}
		else
		{
			$pago = $cotizacion->pagos()->find($id);
			
			if (is_null($pago))
			{
				return $this->response->errorNotFound('El ID del pago no corresponde a la cotización.');
			}
			else
			{
				$valido = $request->get('valido');
				
				if ($pago->valido == false)
				{
					$pago->valido = $valido;
					$pago->save();
					
					/**
					 * @TODO Revisar que todos los pagos estén validados para abrir nuevo caso
					 */
					$pagos = $cotizacion->pagos;
					$todosValidos = true;
					foreach ($pagos as $pago)
					{
						if (!$pago->valido)
						{
							$todosValidos = false;
							break;
						}
					}
					
					if ($todosValidos)
					{
						// La cotizacion la marco como pagada
						$cotizacion->estatus_id = CotizacionEstatus::PAGADA;
						$cotizacion->save();
						
						// Creo un nuevo caso
						$caso = new Caso();
						$caso->cliente_id = $cotizacion->cliente->id;
						$caso->estatus_id = CasoEstatus::PORASIGNAR;
						$caso->save();
						
						$caso->cotizacion()->create([
							'cotizacion_id' => $cotizacion->id
						]);
						// Response con tranformer que indica caso nuevo
						dd($caso);
					}
					else
					{
						
					}
				}
				
				//return $this->response->item($pago, new CotizacionPagosTransformer());
			}
		}
	}
}
