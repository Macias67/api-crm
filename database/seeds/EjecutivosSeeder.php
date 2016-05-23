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
		
		for ($i=0; $i<2; $i++)
		{
			DB::table('ec_ejecutivos')->insert([
				'nombre'       => $faker->name,
				'apellido'     => $faker->lastName,
				'email'        => $faker->email,
				'password'     => bcrypt('secret'),
				'oficina_id'      => 1,
				'departamento_id' => 1,
				'created_at'   => date('Y-m-d H:i:s'),
				'updated_at'   => date('Y-m-d H:i:s'),
			]);
		}

	}
}
