<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Cotizacion as CotizacionModel;
use App\Http\Requests\Create\CotizacionRequest;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Transformers\CotizacionTransformer;

class Cotizacion extends Controller
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
	 * @param \App\Http\Requests\Create\CotizacionRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(CotizacionRequest $request)
	{
		$request->merge([
			'ejecutivo_id' => $request->user()->id,
			'oficina_id'   => $request->user()->oficina_id,
			'estatus_id'   => 1
		]);
		
		$cotizacion = CotizacionModel::create($request->only([
			'cliente_id',
			'contacto_id',
			'vencimiento',
			'cxc',
			'subtotal',
			'iva',
			'total'
		]));
		
		$cotizacion->productos()->saveMany($request->get('productos'));
		$cotizacion->bancos()->saveMany($request->get('bancos'));
		
		return $this->response->item($cotizacion, new CotizacionTransformer());
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
