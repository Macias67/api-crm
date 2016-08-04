<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\Clientes;
use App\Http\Models\Cotizacion as CotizacionModel;
use App\Http\Models\CotizacionBancos;
use App\Http\Models\CotizacionEstatus;
use App\Http\Models\CotizacionProductos;
use App\Http\Requests\Create\CotizacionRequest;
use App\Transformers\CotizacionTransformer;
use App\Transformers\Datatable\CotizacionDataTableTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Facades\Datatables;

class Cotizacion extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$param = Input::all();
		
		if (count($param) > 0)
		{
			if (array_key_exists('estatus', $param))
			{
				$cotizaciones = CotizacionModel::where('estatus_id', '=', $param['estatus'])->get();
				
				return $this->response->collection($cotizaciones, new CotizacionTransformer());
			}
		}
		
		if (Input::exists('q'))
		{
			$value = Input::get('q');
			//$cliente = DB::table(ClienteModel::table())->where('razonsocial', $value)->first();
			
			$cliente = CotizacionModel::where('razonsocial', 'like', '%' . $value . '%')
			                          ->orWhere('rfc', 'like', '%' . $value . '%')
			                          ->get();
			
			return $this->response->collection($cliente, new CotizacionTransformer());
			//dd($cliente);
			
			//return $this->response->item($cliente, new ClienteTransformer());
		}
		else
		{
			return $this->response->collection(CotizacionModel::get(), new CotizacionTransformer());
		}
	}
	
	public function datatable(Request $request)
	{
		$cotizaciones = CotizacionModel::select([CotizacionModel::table() . '.*', Clientes::table() . '.razonsocial'])
		                               ->join(Clientes::table(), CotizacionModel::table() . '.cliente_id', '=', Clientes::table() . '.id');
		
		return Datatables::of($cotizaciones)
		                 ->filterColumn(Clientes::table() . '.razonsocial', function ($query, $keyword)
		                 {
			                 dd($query);
			                 $query->whereRaw(Clientes::table() . ".razonsocial like ?", ["%{$keyword}%"]);
		                 })
//		                 ->editColumn('razonsocial', function ($model)
//		                 {
//			                 return $model->cliente->razonsocial;
//		                 })
                                 ->setTransformer(new CotizacionDataTableTransformer())
		                 ->make(true);
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
	 * @param \App\Http\Requests\Create\CotizacionRequest $request
	 *
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(CotizacionRequest $request)
	{
		DB::beginTransaction(); //Start transaction!
		
		try
		{
			$request->merge([
				'ejecutivo_id' => $request->user()->id,
				'oficina_id'   => $request->user()->oficina_id,
				'estatus_id'   => CotizacionEstatus::PORPAGAR,
			]);
			
			$cotizacion = CotizacionModel::create($request->only([
				'cliente_id',
				'ejecutivo_id',
				'contacto_id',
				'oficina_id',
				'estatus_id',
				'vencimiento',
				'cxc',
				'subtotal',
				'iva',
				'total'
			]));
			
			$productos = $request->get('productos');
			
			foreach ($productos as $index => $producto)
			{
				$cotizacion->productos()->save(new CotizacionProductos([
					'id_producto' => $producto['id'],
					'cantidad'    => $producto['cantidad'],
					'precio'      => $producto['precio'],
					'descuento'   => $producto['descuento'],
					'subtotal'    => $producto['subtotal'],
					'iva'         => $producto['iva'],
					'total'       => $producto['total']
				]));
			}
			
			$bancos = $request->get('bancos');
			foreach ($bancos as $banco)
			{
				$cotizacion->bancos()->save(new CotizacionBancos([
					'id_banco' => $banco
				]));
			}
			
			DB::commit();
			
			/**
			 * @TODO enviar email al cliente con detalles de la cotizacion
			 *
			 */
			
			return $this->response->item($cotizacion, new CotizacionTransformer());
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
		$cotizacion = CotizacionModel::find($id);
		
		if (is_null($cotizacion))
		{
			return $this->response->errorNotFound('El ID de la cotización  no existe.');
		}
		else
		{
			return $this->response->item($cotizacion, new CotizacionTransformer());
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
