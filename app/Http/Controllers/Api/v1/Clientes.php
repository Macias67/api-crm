<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Clientes as ClienteModel;
use App\Http\Requests\Create\ClienteRequest;
use App\QueryBuilder\ClienteQueryBuilder;
use App\Transformers\ClienteTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class Clientes extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$queryBuilder = new ClienteQueryBuilder(new ClienteModel, $request);
		$clientes = $queryBuilder->build()->get();
		
		return $this->response->collection($clientes, new ClienteTransformer());
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
		try
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
			
			$cliente->registro()->create([
				'id_ejecutivo' => $request->user()->id
			]);
			
			return $this->response->item($cliente, new ClienteTransformer());
			
		}
		catch (\Exception $e)
		{
			throw new \Symfony\Component\HttpKernel\Exception\HttpException(500, $e->getMessage());
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
	
	public function datatable() {
		return Datatables::eloquent(ClienteModel::query())->setTransformer(new ClienteTransformer())->make(true);
	}
}
