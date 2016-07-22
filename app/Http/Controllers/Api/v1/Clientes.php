<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Clientes as ClienteModel;
use App\Http\Requests\Create\ClienteRequest;
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
		if (Input::exists('q'))
		{
			$value = Input::get('q');
			//$cliente = DB::table(ClienteModel::table())->where('razonsocial', $value)->first();
			
			$cliente = ClienteModel::where('razonsocial', 'like', '%' . $value . '%')
			                       ->orWhere('rfc', 'like', '%' . $value . '%')
			                       ->get();
			
			return $this->response->collection($cliente, new ClienteTransformer());
			//dd($cliente);
			
			//return $this->response->item($cliente, new ClienteTransformer());
		}
		else
		{
			return $this->response->collection(ClienteModel::isOnline()->get(), new ClienteTransformer());
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
		$cliente = ClienteModel::find($id);
		
		if (is_null($cliente))
		{
			return $this->response->errorNotFound('El ID del cliente no existe.');
		}
		else
		{
			return $this->response->item($cliente, new ClienteTransformer());
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
}
