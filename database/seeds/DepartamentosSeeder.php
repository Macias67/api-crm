<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();
		
		DB::table('ec_departamentos')->insert([
			'area' => 'Ventas'
		]);
		
		DB::table('ec_departamentos')->insert([
			'area' => 'Soporte Técnico'
		]);
	}
}
