<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Productos as ProductosModel;
use App\Http\Requests;
use App\Http\Requests\Create\ProductoRequest;
use App\Transformers\ProductoTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class Productos extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return $this->response->collection(ProductosModel::get(), new ProductoTransformer());
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
	 * @param \App\Http\Requests\Create\ProductoRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProductoRequest $request)
	{
		$request->merge(['online' => true]);

		$producto = ProductosModel::create($request->only([
			'id_unidad',
			'codigo',
			'producto',
			'descripcion',
			'precio',
			'online'
		]));

		return $this->response->item($producto, new ProductoTransformer());
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
