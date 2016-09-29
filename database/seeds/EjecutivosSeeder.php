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
		
		\App\Http\Models\Ejecutivo::create([
			'id'          => 1,
			'oficina_id'      => 1,
			'departamento_id' => 3,
			'color'           => '#F2784B',
			'class'           => 'yellow-casablanca'
		]);
		
		\App\Http\Models\Ejecutivo::create([
			'id'          => 2,
			'oficina_id'      => 1,
			'departamento_id' => 2,
			'color'           => '#BF55EC',
			'class'           => 'purple-medium',
			'created_at'      => date('Y-m-d H:i:s'),
			'updated_at'      => date('Y-m-d H:i:s'),
		]);
		
		\App\Http\Models\Ejecutivo::create([
			'id'          => 3,
			'oficina_id'      => 1,
			'departamento_id' => 1,
			'color'           => '#44B6AE',
			'class'           => 'green-haze',
			'created_at'      => date('Y-m-d H:i:s'),
			'updated_at'      => date('Y-m-d H:i:s'),
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
