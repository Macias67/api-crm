<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EjecutivosSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();
		
		DB::table('ec_ejecutivos')->insert([
			'nombre'       => 'Luis',
			'apellido'     => 'Macias',
			'email'        => 'luismacias.angulo@gmail.com',
			'password'     => bcrypt('secret'),
			'oficina_id'      => 1,
			'departamento_id' => 3,
			'created_at'   => date('Y-m-d H:i:s'),
			'updated_at'   => date('Y-m-d H:i:s'),
		]);
		
		DB::table('ec_ejecutivos')->insert([
			'nombre'       => 'Eleazar',
			'apellido'     => 'Frías',
			'email'        => 'eleazar.frias@gmail.com',
			'password'     => bcrypt('secret'),
			'oficina_id'      => 1,
			'departamento_id' => 2,
			'created_at'   => date('Y-m-d H:i:s'),
			'updated_at'   => date('Y-m-d H:i:s'),
		]);
		
		DB::table('ec_ejecutivos')->insert([
			'nombre'       => 'Gloria',
			'apellido'     => 'Camarena',
			'email'        => 'gloria.camarena@gmail.com',
			'password'     => bcrypt('secret'),
			'oficina_id'      => 1,
			'departamento_id' => 1,
			'created_at'   => date('Y-m-d H:i:s'),
			'updated_at'   => date('Y-m-d H:i:s'),
		]);
		
//		for ($i=0; $i<2; $i++)
//		{
//			DB::table('ec_ejecutivos')->insert([
//				'nombre'       => $faker->name,
//				'apellido'     => $faker->lastName,
//				'email'        => $faker->email,
//				'password'     => bcrypt('secret'),
//				'oficina_id'      => 1,
//				'departamento_id' => 1,
//				'created_at'   => date('Y-m-d H:i:s'),
//				'updated_at'   => date('Y-m-d H:i:s'),
//			]);
//		}
	}
}
