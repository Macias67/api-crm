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
		
		\App\Http\Models\CotizacionProductos::create([
			'id'           => 2,
			'id_cotizacion'   => 2,
			'id_producto' => 1,
			'cantidad'  => 1,
			'precio'   => 5500,
			'descuento'   => 0,
			'subtotal'  => 5500,
			'iva'          => 880,
			'total'     => 6380,
			'habilitado'          => 1
		]);
		
		\App\Http\Models\CotizacionProductos::create([
			'id'           => 3,
			'id_cotizacion'   => 2,
			'id_producto' => 2,
			'cantidad'  => 1,
			'precio'   => 3500,
			'descuento'   => 0,
			'subtotal'  => 3500,
			'iva'          => 400,
			'total'     => 3900,
			'habilitado'          => 1
		]);
		
		\App\Http\Models\CotizacionProductos::create([
			'id'           => 4,
			'id_cotizacion'   => 3,
			'id_producto' => 2,
			'cantidad'  => 1,
			'precio'   => 620,
			'descuento'   => 0,
			'subtotal'  => 620,
			'iva'          => 0,
			'total'     => 620,
			'habilitado'          => 1
		]);
	}
}
