<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(UserAppSeeder::class);
		$this->call(DepartamentosSeeder::class);
		$this->call(OficinasSeeder::class);
		$this->call(EjecutivosSeeder::class);
		$this->call(BancoSeeder::class);
		$this->call(ClientesSeeder::class);
		$this->call(ContactosSeeder::class);
		$this->call(UnidadProductosSeeder::class);
		$this->call(ProductosSeeder::class);
		$this->call(CotizacionStatusSeeder::class);
		$this->call(CasoStatusSeeder::class);
		
		//Cotizaciones
		$this->call(CotizacionSeeder::class);
		$this->call(CotizacionProductosSeeder::class);
		$this->call(CotizacionPagosSeeder::class);
		$this->call(CotizacionComprobantesSeeder::class);
		
		// Tareas
		$this->call(TareaStatusSeeder::class);
	}
}
