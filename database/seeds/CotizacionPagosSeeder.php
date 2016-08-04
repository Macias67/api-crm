<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CotizacionPagosSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('ct_cotizacion_pagos')->insert([
			'id'            => 1,
			'cotizacion_id' => 1,
			'contacto_id'   => 1,
			'cantidad'      => 6380,
			'comentario'    => 'Copia comprobante pago',
			'valido'        => 0,
			'created_at'    => date('Y-m-d H:i:s', time()),
			'updated_at'    => date('Y-m-d H:i:s', time())
		]);
	}
}
