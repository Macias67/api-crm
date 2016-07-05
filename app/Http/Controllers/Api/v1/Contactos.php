<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Contactos as ContactosModel;
use App\Http\Requests;
use App\Http\Requests\create\ContactoRequest;
use App\Transformers\ContactoTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class Contactos extends Controller
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
	 * @param \App\Http\Requests\create\ContactoRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(ContactoRequest $request)
	{
		$request->merge([
			'password' => bcrypt('olakace')
		]);

		$contacto = ContactosModel::create($request->only([
			'id_cliente',
			'nombre',
			'apellido',
			'email',
		]));

		return $this->response->item($contacto, new ContactoTransformer());
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
