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
	
	/**
	 * @TODO Endpoint de prueba para actualizar token
	 */
	$api->post('token', ['uses' => 'Auth@tokenRefresh']);
	
	$api->group(['middleware' => 'jwt.auth'], function ($api)
	{
		$api->get('/me', 'Auth@me');
		//$api->get('validatetoken', 'Auth@validateToken');
		
		/**
		 * Logs
		 */
		$api->resource('logs', 'Log');
		
		/**
		 * Tokens
		 */
		$api->resource('tokens', 'Tokens');
		
		/**
		 * Cotizacion
		 */
		$api->post('cotizaciones/datatable', 'Cotizacion@datatable');
		$api->resource('cotizaciones', 'Cotizacion');
		$api->group(['prefix' => 'cotizaciones/{idCotizacion}'], function ($api)
		{
			$api->put('pagos/{idPago}/valida', 'Pagos@validaPago');
			
			/**
			 * Pagos
			 */
			$api->resource('pagos', 'Pagos');
		});
		
		/**
		 * Ejecutivo
		 */
		$api->resource('ejecutivos', 'Ejecutivos');
		$api->group(['prefix' => 'ejecutivos/{idEjecutivo}'], function ($api)
		{
			/**
			 * Lider
			 */
			$api->resource('agenda', 'EjecutivoAgenda');
		});
		
		/**
		 * Casos
		 */
		$api->resource('casos', 'Casos');
		$api->group(['prefix' => 'casos/{idCaso}'], function ($api)
		{
			/**
			 * Lider
			 */
			$api->resource('lider', 'CasoLider');
			
			/**
			 * CasoTareas
			 */
			$api->resource('tareas', 'CasoTareas');
		});
		
		/**
		 * Tareas
		 */
		$api->resource('tareas', 'Tareas');
		$api->group(['prefix' => 'tareas/{idTarea}'], function ($api)
		{
			/**
			 * Establece fechas
			 */
			$api->put('fechas', 'Tareas@asignaFechas');
			
			/**
			 * TareaAgenda
			 */
			$api->resource('agenda', 'TareaAgenda');
			
			/**
			 * TareaNotas
			 */
			$api->resource('notas', 'TareaNotas');
			
			/**
			 * TareaTiempos
			 */
			$api->resource('tiempos', 'TareaTiempos');
		});
		
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
		
		/**
		 * Agenda
		 */
		$api->resource('agenda', 'Agenda');
	});
});
