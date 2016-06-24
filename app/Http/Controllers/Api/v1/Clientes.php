<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Clientes as ClienteModel;
use App\Http\Requests;
use App\Http\Requests\create\ClienteRequest;
use App\Transformers\ClienteTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class Clientes extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return $this->response->collection(ClienteModel::isOnline()->get(), new ClienteTransformer());
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
	 * @param \App\Http\Requests\create\ClienteRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(ClienteRequest $request)
	{
		$cliente = ClienteModel::create($request->only([
			'razonsocial',
			'rfc',
			'email',
			'telefono',
			'telefono2',
			'tipo',
			'calle',
			'noexterior',
			'nointerior',
			'colonia',
			'cp',
			'ciudad',
			'municipio',
			'estado',
			'pais'
		]));

		return $this->response->item($cliente, new ClienteTransformer());
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
