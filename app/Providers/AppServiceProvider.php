<?php

namespace App\Providers;

use App\Http\Models\Caso;
use App\Http\Models\Cotizacion;
use App\Http\Models\Tarea;
use App\Observers\CasoObserver;
use App\Observers\CotizacionObserver;
use App\Observers\TareaObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Cotizacion::observe(CotizacionObserver::class);
		Caso::observe(CasoObserver::class);
		Tarea::observe(TareaObserver::class);
	}
	
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		
	}
}
