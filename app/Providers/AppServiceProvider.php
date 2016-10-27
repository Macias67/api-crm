<?php

namespace App\Providers;

use App\Http\Models\Cotizacion;
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
