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
		DB::table('ec_unidad_productos')->insert([
			'unidad'      => 'sistema',
			'plural'      => 'sistemas',
			'abreviatura' => 'sist',
			'online'      => 1
		]);
	}
}
