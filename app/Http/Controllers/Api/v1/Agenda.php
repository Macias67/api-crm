<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Agenda as AgendaModel;
use App\Http\Requests\Create\AgendaRequest;
use App\QueryBuilder\AgendaQueryBuilder;
use App\Transformers\AgendaTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Agenda extends Controller
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
		$queryBuilder = new AgendaQueryBuilder(new AgendaModel, $request);
		
		return $this->response->collection($queryBuilder->build()->get(), new AgendaTransformer());
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
	 * @param \App\Http\Requests\Create\AgendaRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(AgendaRequest $request)
	{
		DB::beginTransaction();
		try
		{
			$agenda = AgendaModel::create([
				'ejecutivo_id' => $request->get('ejecutivo'),
				'titulo'       => $request->get('titulo'),
				'descripcion'  => $request->get('descripcion'),
				'start'        => $request->get('start'),
				'end'          => $request->get('end'),
				'url'          => $request->get('url'),
				'referencia'   => $request->get('referencia')
			]);
			
			DB::commit();
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
