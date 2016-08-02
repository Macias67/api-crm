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
			'id' => 1,
			'estatus' => 'Por Pagar',
			'color'   => '#1BBC9B',
			'class'   => 'bg-green-meadow bg-font-green-meadow'
		]);
		
		DB::table('ct_cotizacion_estatus')->insert([
			'id' => 2,
			'estatus' => 'Revisión',
			'color'   => '#F2784B',
			'class'   => 'bg-yellow-casablanca bg-font-yellow-casablanca'
		]);
		
		DB::table('ct_cotizacion_estatus')->insert([
			'id' => 3,
			'estatus' => 'Irregular',
			'color'   => '#F3C200',
			'class'   => 'bg-yellow-crusta bg-font-yellow-crusta'
		]);
		
		DB::table('ct_cotizacion_estatus')->insert([
			'id' => 4,
			'estatus' => 'Pagada',
			'color'   => '#4B77BE',
			'class'   => 'bg-blue-steel bg-font-blue-steel'
		]);
		
		DB::table('ct_cotizacion_estatus')->insert([
			'id' => 5,
			'estatus' => 'Abonada',
			'color'   => '#8775A7',
			'class'   => 'bg-purple-plum bg-font-purple-plum'
		]);
		
		DB::table('ct_cotizacion_estatus')->insert([
			'id' => 6,
			'estatus' => 'Vencida',
			'color'   => '#ACB5C3',
			'class'   => 'bg-grey-salsa bg-font-grey-salsa'
		]);
		
		DB::table('ct_cotizacion_estatus')->insert([
			'id' => 7,
			'estatus' => 'Cancelada',
			'color'   => '#D91E18',
			'class'   => 'bg-red-thunderbird bg-font-red-thunderbird'
		]);
	}
}
