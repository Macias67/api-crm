<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\ClienteContactos as ContactosModel;
use App\Http\Models\Clientes as ClientesModel;
use App\Http\Requests;
use App\Http\Requests\create\ClienteContactoRequest;
use App\Transformers\ClienteContactoTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class ClienteContactos extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @param $id_cliente
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($id_cliente)
	{
		return $this->response->collection(ContactosModel::fromCliente($id_cliente)->get(), new ClienteContactoTransformer());
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
	 * @TODO Añadir funcionamiento de enviar email cuando el contacto es envíado
	 *
	 * @param \App\Http\Requests\create\ClienteContactoRequest $request
	 * @param                                                  $id_cliente
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(ClienteContactoRequest $request, $id_cliente)
	{
		if (ClientesModel::where('id', $id_cliente)->exists())
		{
			$request->merge([
				'id_cliente' => $id_cliente,
				'password'   => bcrypt('olakace'),
				'online'     => true,
			]);
			
			$contacto = ContactosModel::create($request->only([
				'id_cliente',
				'nombre',
				'apellido',
				'email',
				'password',
				'telefono',
				'online'
			]));
			
			return $this->response->item($contacto, new ClienteContactoTransformer());
		}
		else
		{
			return $this->response->errorNotFound('El ID del cliente no existe.');
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
