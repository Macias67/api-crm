<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Models\UnidadesProductos;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Create\UnidadProductoRequest;
use App\Transformers\UnidadTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class Unidades extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return $this->response->collection(UnidadesProductos::all(), new UnidadTransformer());
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
	 * @param \App\Http\Requests\Create\UnidadProductoRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(UnidadProductoRequest $request)
	{
		$unidad = UnidadesProductos::create($request->only([
			'unidad',
			'plural',
			'abreviatura'
		]));
		
		return $this->response->item($unidad, new UnidadTransformer());
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
