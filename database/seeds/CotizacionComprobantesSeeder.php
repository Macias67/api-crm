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
		\App\Http\Models\CotizacionComprobantes::create([
			'id'            => 1,
			'pago_id' => 1,
			'archivo'   => 'scanner.jpg',
			'nombre'      => 'scanner',
			'extension'    => 'jpg'
		]);
	}
}
