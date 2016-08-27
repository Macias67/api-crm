<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('cs_caso')->insert([
			'id' => 1,
			'cliente_id'     => 1,
			'estatus_id'   => \App\Http\Models\CasoEstatus::PORASIGNAR,
			'asignado'      => 0,
			'fecha_inicio'   => null,
			'fecha_tentativa_cierre'   => null,
			'fecha_termino'     => null,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
		
		DB::table('cs_caso_cotizacion')->insert([
			'id'                     => 1,
			'caso_id'             => 1,
			'cotizacion_id'             => 1,
			'fecha_validacion'           => date('Y-m-d H:i:s'),
			'created_at'             => date('Y-m-d H:i:s'),
			'updated_at'             => date('Y-m-d H:i:s')
		]);
	}
}
