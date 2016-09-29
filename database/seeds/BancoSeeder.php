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
			\App\Http\Models\Bancos::create([
				'banco'      => 'BANAMEX',
				'sucursal'   => '2346',
				'cta'        => '73919374019231',
				'titular'    => $faker->firstName . ' ' . $faker->lastName,
				'cib'        => $faker->creditCardNumber,
				'online'     => 1
			]);
		}
	}
}
