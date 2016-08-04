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
		DB::table('ct_cotizacion_productos')->insert([
			'id'           => 1,
			'id_cotizacion'   => 1,
			'id_producto' => 1,
			'cantidad'  => 1,
			'precio'   => 5500,
			'descuento'   => 0,
			'subtotal'  => 5500,
			'iva'          => 880,
			'total'     => 6380,
			'habilitado'          => 1,
			'created_at'   => date('Y-m-d H:i:s', time()),
			'updated_at'   => date('Y-m-d H:i:s', time())
		]);
	}
}
