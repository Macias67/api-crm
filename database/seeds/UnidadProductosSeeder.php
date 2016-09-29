<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadProductosSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\App\Http\Models\UnidadesProductos::create([
			'unidad'      => 'sistema',
			'plural'      => 'sistemas',
			'abreviatura' => 'sist',
			'online'      => 1
		]);
	}
}
