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
		$this->call(DepartamentosSeeder::class);
		$this->call(OficinasSeeder::class);
		$this->call(EjecutivosSeeder::class);
		$this->call(BancoSeeder::class);
		$this->call(ClientesSeeder::class);
		$this->call(ContactosSeeder::class);
		$this->call(UnidadProductosSeeder::class);
		$this->call(ProductosSeeder::class);
		$this->call(CotizacionStatusSeeder::class);
	}
}
