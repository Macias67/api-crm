<?php

use Illuminate\Database\Seeder;

class CotizacionStatusSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('ct_cotizacion_estatus')->insert([
			'estatus' => 'Por Pagar',
			'color'     => '#000'
		]);
	}
}
