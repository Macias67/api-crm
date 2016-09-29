<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactosSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();
		
		\App\Http\Models\Contactos::create([
			'id' => 4,
			'id_cliente' => 1,
			'telefono'   => '3929418119',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
		
		for ($i = 0; $i < 15; $i++)
		{
			\App\Http\Models\Contactos::create([
				'id' => ($i + 5),
				'id_cliente' => rand(1, 10),
				'telefono'   => '392'.$faker->randomNumber(7),
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			]);
		}
	}
}
