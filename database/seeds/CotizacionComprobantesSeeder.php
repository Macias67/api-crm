<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CotizacionComprobantesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('ct_cotizacion_comprobantes')->insert([
			'id'            => 1,
			'pago_id' => 1,
			'archivo'   => 'scanner.jpg',
			'nombre'      => 'scanner',
			'extension'    => 'jpg',
			'created_at'    => date('Y-m-d H:i:s', time()),
			'updated_at'    => date('Y-m-d H:i:s', time())
		]);
	}
}
