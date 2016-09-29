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
		
		\App\Http\Models\Departamentos::create([
			'area' => 'Ventas'
		]);
		
		\App\Http\Models\Departamentos::create([
			'area' => 'Soporte Técnico'
		]);
		
		\App\Http\Models\Departamentos::create([
			'area' => 'Desarrollo'
		]);
		
//		DB::table('ec_departamentos')->insert([
//			'area' => 'Ventas'
//		]);
//
//		DB::table('ec_departamentos')->insert([
//			'area' => 'Soporte Técnico'
//		]);
//
//		DB::table('ec_departamentos')->insert([
//			'area' => 'Desarrollo'
//		]);
	}
}
