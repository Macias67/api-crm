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
		\App\Http\Models\Cotizacion::create([
			'id'           => 1,
			'cliente_id'   => 1,
			'ejecutivo_id' => 1,
			'contacto_id'  => 4,
			'oficina_id'   => 1,
			'estatus_id'   => \App\Http\Models\CotizacionEstatus::REVISION,
			'vencimiento'  => date('Y-m-d H:i:s', time() + (60 * 60 * 24 * 16)),
			'cxc'          => 0,
			'subtotal'     => 5500,
			'iva'          => 880,
			'total'        => 6380,
			'created_at'   => date('Y-m-d H:i:s', time()),
			'updated_at'   => date('Y-m-d H:i:s', time())
		]);
		
		\App\Http\Models\Cotizacion::create([
			'id'           => 2,
			'cliente_id'   => 1,
			'ejecutivo_id' => 1,
			'contacto_id'  => 4,
			'oficina_id'   => 1,
			'estatus_id'   => \App\Http\Models\CotizacionEstatus::PORPAGAR,
			'vencimiento'  => date('Y-m-d H:i:s', time() + (60 * 60 * 24 * 16)),
			'cxc'          => 0,
			'subtotal'     => 3000,
			'iva'          => 750,
			'total'        => 10280,
			'created_at'   => date('Y-m-d H:i:s', time()),
			'updated_at'   => date('Y-m-d H:i:s', time())
		]);
		
		\App\Http\Models\Cotizacion::create([
			'id'           => 3,
			'cliente_id'   => 1,
			'ejecutivo_id' => 1,
			'contacto_id'  => 4,
			'oficina_id'   => 1,
			'estatus_id'   => \App\Http\Models\CotizacionEstatus::PORPAGAR,
			'vencimiento'  => date('Y-m-d H:i:s', time() + (60 * 60 * 24 * 16)),
			'cxc'          => 0,
			'subtotal'     => 570,
			'iva'          => 50,
			'total'        => 620,
			'created_at'   => date('Y-m-d H:i:s', time()),
			'updated_at'   => date('Y-m-d H:i:s', time())
		]);
	}
}
