<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Oficinas as OficinaModel;
use App\Http\Requests;
use App\Http\Requests\create\OficinaRequest;
use App\Transformers\OficinaTransformer;
use Dingo\Api\Routing\Helpers;

class Oficinas extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return $this->response->collection(OficinaModel::isOnline()->get(), new OficinaTransformer());
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
	 *
	 * @param \App\Http\Requests\create\OficinaRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(OficinaRequest $request)
	{
		$oficina = OficinaModel::create($request->only([
			'calle',
			'numero',
			'colonia',
			'cp',
			'ciudad',
			'estado',
			'latitud',
			'longitud',
			'telefonos',
			'email'
		]));
		
		return $this->response->item($oficina, new OficinaTransformer());
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
		$oficina = OficinaModel::find($id);
		
		if ($oficina)
		{
			return $this->response->item($oficina, new OficinaTransformer());
		}
		else
		{
			return $this->response->errorNotFound('Oficina no econtrada');
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
	 * @param \App\Http\Requests\create\OficinaRequest $request
	 * @param  int                                     $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(OficinaRequest $request, $id)
	{
		$oficina = OficinaModel::find($id);
		$oficina->update($request->all());
		
		return $this->response->item($oficina, new OficinaTransformer());
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

	}
}
