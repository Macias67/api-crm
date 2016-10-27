<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log extends Controller
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
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$tipo = $request->get('tipo');
		
		switch ($tipo)
		{
			case 'error':
				$path = 'errores.log';
				$tipo = 'error';
				break;
			default:
				$path = 'errores.log';
				$tipo = 'error';
				break;
		}
		
		$logger = new Logger('LOGS');
		$logger->pushHandler(new StreamHandler(storage_path('logs/' . $path)));
		$logMessage = 'Ocurrió@' . date('d-m-Y H:m:i A') . ' | ' . $request->get('message') . ' | ' . $request->get('statusText') . ' | ' . $request->get('status') . PHP_EOL;
		$exito = $logger->{$tipo}($logMessage);
		
		if ($exito)
		{
			return $this->response->created();
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
