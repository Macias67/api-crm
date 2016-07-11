<?php

Route::get('/', function ()
{
	return view('welcome');
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\v1', 'middleware' => 'api'], function ($api)
{
	/**
	 * Auth
	 */
	$api->post('auth', ['uses' => 'Auth@authenticate']);
	
	$api->group(['middleware' => 'jwt.auth'], function ($api)
	{
		$api->get('/me', 'Auth@me');
		//$api->get('validatetoken', 'Auth@validateToken');
		
		/**
		 * Ejecutivo
		 */
		$api->resource('ejecutivos', 'Ejecutivos');
		
		/**
		 * Clientes
		 */
		$api->resource('clientes', 'Clientes');
		$api->group(['prefix' => 'clientes/{id}'], function ($api)
		{
			/**
			 * Contactos
			 */
			$api->resource('contactos', 'ClienteContactos');
		});
		
		/**
		 * Oficinas
		 */
		$api->resource('oficinas', 'Oficinas');
		
		/**
		 * Productos
		 */
		$api->resource('productos', 'Productos');
		
		/**
		 * Unidades
		 */
		$api->resource('unidades', 'Unidades');
		
		/**
		 * Bancos
		 */
		$api->resource('bancos', 'Bancos');
	});
});
