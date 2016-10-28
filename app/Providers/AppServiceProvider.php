<?php

namespace App\Providers;

use App\Http\Models\Caso;
use App\Http\Models\Cotizacion;
use App\Observers\CasoObserver;
use App\Observers\CotizacionObserver;
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
	}
	
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
