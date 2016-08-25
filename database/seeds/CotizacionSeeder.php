<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CotizacionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('ct_cotizacion')->insert([
			'id'           => 1,
			'cliente_id'   => rand(1, 10),
			'ejecutivo_id' => 1,
			'contacto_id'  => 1,
			'oficina_id'   => 1,
			'estatus_id'   => 2,
			'vencimiento'  => date('Y-m-d H:i:s', time() + (60 * 60 * 24 * 16)),
			'cxc'          => 0,
			'subtotal'     => 5500,
			'iva'          => 880,
			'total'        => 6380,
			'created_at'   => date('Y-m-d H:i:s', time()),
			'updated_at'   => date('Y-m-d H:i:s', time())
		]);
	}
}
