<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BancoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();
		
		for ($i = 0; $i < 3; $i++)
		{
			DB::table('ec_bancos')->insert([
				'banco'      => $faker->company,
				'sucursal'   => $faker->randomNumber(4),
				'cta'        => $faker->randomNumber(4),
				'titular'    => $faker->firstName . ' ' . $faker->lastName,
				'cib'        => $faker->creditCardNumber,
				'online'     => 1,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			]);
		}
	}
}
