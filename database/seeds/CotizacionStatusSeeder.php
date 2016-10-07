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
		\App\Http\Models\CotizacionEstatus::create([
			'id' => 1,
			'estatus' => 'Por Pagar',
			'color'   => '#1BBC9B',
			'class'   => 'green-meadow'
		]);
		
		\App\Http\Models\CotizacionEstatus::create([
			'id' => 2,
			'estatus' => 'Revisión',
			'color'   => '#F2784B',
			'class'   => 'yellow-casablanca'
		]);
		
		\App\Http\Models\CotizacionEstatus::create([
			'id' => 3,
			'estatus' => 'Irregular',
			'color'   => '#F3C200',
			'class'   => 'yellow-crusta'
		]);
		
		\App\Http\Models\CotizacionEstatus::create([
			'id' => 4,
			'estatus' => 'Pagada',
			'color'   => '#4B77BE',
			'class'   => 'blue-steel'
		]);
		
		\App\Http\Models\CotizacionEstatus::create([
			'id' => 5,
			'estatus' => 'Abonada',
			'color'   => '#8775A7',
			'class'   => 'purple-plum'
		]);
		
		\App\Http\Models\CotizacionEstatus::create([
			'id' => 6,
			'estatus' => 'Vencida',
			'color'   => '#ACB5C3',
			'class'   => 'grey-salsa'
		]);
		
		\App\Http\Models\CotizacionEstatus::create([
			'id' => 7,
			'estatus' => 'Cancelada',
			'color'   => '#D91E18',
			'class'   => 'red-thunderbird'
		]);
	}
}
