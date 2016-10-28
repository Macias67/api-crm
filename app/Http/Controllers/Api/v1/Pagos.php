<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\CasoPorAsignar;
use App\Events\ContactoSubePago;
use App\Events\NotificaUsuario;
use App\Events\Pago\PagoSubido;
use App\Http\Controllers\Controller;
use App\Http\Models\Caso;
use App\Http\Models\CasoCotizacion;
use App\Http\Models\CasoEstatus;
use App\Http\Models\Cotizacion as CotizacionModel;
use App\Http\Models\CotizacionEstatus;
use App\Http\Models\FBNotification;
use App\Http\Requests\Create\CotizacionPagoRequest;
use App\Transformers\CasoTransformer;
use App\Transformers\CotizacionPagosTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
	 * @param \App\Http\Requests\Create\CotizacionPagoRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(CotizacionPagoRequest $request)
	{
		try
		{
			$cotizacion = CotizacionModel::find($request->get('cotizacion_id'));
			DB::beginTransaction();
			
			$pago = $cotizacion->pagos()->create([
				'contacto_id' => $request->get('contacto_id'),
				'cantidad'    => $request->get('cantidad'),
				'tipo'        => $request->get('tipo'),
				'comentario'  => $request->get('comentario')
			]);
			
			$archivo = $request->get('archivo');
			$pago->comprobantes()->create([
				'download_url' => $archivo['url'],
				'content_type' => $archivo['contentType'],
				'full_path'    => $archivo['fullPath'],
				'md5hash'      => $archivo['hash'],
				'name'         => $archivo['name'],
				'size'         => $archivo['size']
			]);
			
			// Se cambia el status de la cotizacción a Revisión
			$cotizacion->estatus_id = CotizacionEstatus::REVISION;
			$cotizacion->save();
			
			DB::commit();
			
			/**
			 * @TODO Push Notification en la app. Notificar al usuario de Ventas
			 */
			event(new PagoSubido($pago));
			
			// Solo se sube pago
			return $this->response->created();
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
	 * @param \Illuminate\Http\Request $request
	 * @param                          $idCotizacion
	 * @param                          $id
	 *
	 * @return \Dingo\Api\Http\Response|void
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
				return $this->response->errorNotFound('El ID del pago no corresponde a la cotización o no existe.');
			}
			else
			{
				try
				{
					$valido = $request->get('valido');
					
					DB::beginTransaction();
					
					// SI el pago NO esta válido, entro al proceso
					if ($pago->valido == false)
					{
						$pago->valido = $valido;
						$pago->save();
						
						/**
						 * @TODO Revisar que todos los pagos estén validados para abrir nuevo caso
						 */
						$pagos = $cotizacion->pagos;
						$totalAPagar = 0;
						foreach ($pagos as $pago)
						{
							if ($pago->valido)
							{
								$totalAPagar += $pago->cantidad;
							}
						}
						
						// Cambio el estatus de la cotización segun la cantidad de pagos
						if ($totalAPagar >= $cotizacion->total)
						{
							// La cotizacion la marco como pagada
							$cotizacion->estatus_id = CotizacionEstatus::PAGADA;
						}
						elseif ($totalAPagar < $cotizacion->total)
						{
							// La cotizacion la marco como abonada
							$cotizacion->estatus_id = CotizacionEstatus::ABONADA;
						}
						
						$cotizacion->save();
						
						// Busco en la tabla 'cs_caso_cotizacion' si ya hay un caso ligado a esta cotización
						$casoCotizacion = CasoCotizacion::where('cotizacion_id', $cotizacion->id)->get();
						
						// SI es TRUE el resultado, es porque NO HAY CASO y se debe abrir uno.
						if ($casoCotizacion->isEmpty())
						{
							// Creo un nuevo caso
							$caso = new Caso();
							$caso->cliente_id = $cotizacion->cliente->id;
							$caso->estatus_id = CasoEstatus::PORASIGNAR;
							$caso->save();
							
							// Ligo la cotización al caso
							$caso->casoCotizacion()->create([
								'cotizacion_id'    => $cotizacion->id,
								'fecha_validacion' => date('Y-m-d H:i:s')
							]);
							
							DB::commit();
							
							/**
							 * @TODO Push Notification al asignador de casos.
							 */
														
							return $this->response->item($caso, new CasoTransformer());
						}
						else
						{
							DB::commit();
							
							// Solo valido un pago, sin crear caso
							return $this->response->noContent();
						}
					}
				}
				catch (\Exception $e)
				{
					DB::rollback();
					
					return $this->response->error($e->getMessage(), 500);
				}
			}
		}
	}
}
