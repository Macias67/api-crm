<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Caso;
use App\Transformers\CasoLiderTransformer;
use App\Transformers\CasoTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CasoLider extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($idCaso)
	{
		$caso = Caso::find($idCaso);
		
		if (is_null($caso))
		{
			return $this->response->errorNotFound('El id del caso no existe.');
		}
		elseif (is_null($caso->casoLider))
		{
			return $this->response->errorNotFound('El caso no tiene líder.');
		}
		else
		{
			//dd($caso->casoLider);
			return $this->response->item($caso->casoLider, new CasoLiderTransformer());
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
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return void
	 */
	public function store(Request $request, $idCaso)
	{
		try
		{
			$caso = Caso::find($idCaso);
			
			DB::beginTransaction();
			
			$caso->casoLider()->create([
				'ejecutivo_lider_id'  => $request->get('lider'),
				'ejecutivo_asigna_id' => $request->user()->id
			]);
			
			$caso->asignado = true;
			$caso->save();
			
			DB::commit();
			
			return $this->response->item($caso, new CasoTransformer());
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
	public function show($idCaso)
	{
		dd($idCaso);
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
