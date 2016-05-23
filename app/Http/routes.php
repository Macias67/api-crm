<?php

Route::get('/', function ()
{
	return view('welcome');
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\v1'], function ($api)
{
	/**
	 * Auth
	 */
	$api->post('auth', ['uses' => 'Auth@authenticate', 'middleware' => 'cors']);
	
	$api->group(['middleware' => 'jwt.auth', 'prefix' => 'v1'], function ($api)
	{
		$api->get('/me', 'Auth@me');
		//$api->get('validatetoken', 'Auth@validateToken');
		
		/**
		 * Ejecutivo
		 */
		$api->resource('ejecutivos', 'Ejecutivos');
//		$api->resource('usuarios', 'Usuarios');
//		$api->group(['prefix' => 'usuarios/{id}'], function ($api)
//		{
//			$api->resource('tags', 'UsuariosTags');
//		});
		
		/**
		 * Clientes
		 */
		//$api->resource('clientes', 'Clientes');
		
		/**
		 * Tags
		 */
		//$api->resource('tags', 'Tags');
	});
});
