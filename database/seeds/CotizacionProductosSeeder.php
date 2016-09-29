<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CotizacionProductosSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\App\Http\Models\CotizacionProductos::create([
			'id'           => 1,
			'id_cotizacion'   => 1,
			'id_producto' => 1,
			'cantidad'  => 1,
			'precio'   => 5500,
			'descuento'   => 0,
			'subtotal'  => 5500,
			'iva'          => 880,
			'total'     => 6380,
			'habilitado'          => 1
		]);
	}
}
