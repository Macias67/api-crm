<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
			'color'   => '#1BBC9B',
			'class'   => 'bg-green-meadow bg-font-green-meadow'
		]);
		
		DB::table('ct_cotizacion_estatus')->insert([
			'estatus' => 'Revisión',
			'color'   => '#F2784B',
			'class'   => 'bg-yellow-casablanca bg-font-yellow-casablanca'
		]);
		
		DB::table('ct_cotizacion_estatus')->insert([
			'estatus' => 'Irregular',
			'color'   => '#F3C200',
			'class'   => 'bg-yellow-crusta bg-font-yellow-crusta'
		]);
		
		DB::table('ct_cotizacion_estatus')->insert([
			'estatus' => 'Pagada',
			'color'   => '#4B77BE',
			'class'   => 'bg-blue-steel bg-font-blue-steel'
		]);
		
		DB::table('ct_cotizacion_estatus')->insert([
			'estatus' => 'Vencida',
			'color'   => '#ACB5C3',
			'class'   => 'bg-grey-salsa bg-font-grey-salsa'
		]);
		
		DB::table('ct_cotizacion_estatus')->insert([
			'estatus' => 'Cancelada',
			'color'   => '#D91E18',
			'class'   => 'bg-red-thunderbird bg-font-red-thunderbird'
		]);
	}
}
