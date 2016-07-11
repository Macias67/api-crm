<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();
		
		for ($i = 0; $i < 1200; $i++)
		{
			DB::table('cl_clientes')->insert([
				'razonsocial'  => mb_strtoupper($faker->company) . ' - ' . $faker->randomNumber(4),
				'rfc'          => mb_strtoupper(substr($faker->md5, 0, 13)),
				'prospecto'    => $faker->randomElement([0, 1]),
				'distribuidor' => $faker->randomElement([0, 1]),
				'email'        => $faker->safeEmail,
				'telefono'     => $faker->randomNumber(9) . $faker->randomNumber(1),
				'telefono2'    => '',
				'calle'        => $faker->streetName,
				'noexterior'   => $faker->buildingNumber,
				'nointerior'   => '',
				'colonia'      => $faker->cityPrefix,
				'cp'           => $faker->postcode,
				'ciudad'       => $faker->city,
				'municipio'    => '',
				'estado'       => $faker->state,
				'pais'         => 'México',
				'online'       => 1,
				'created_at'   => date('Y-m-d H:i:s'),
				'updated_at'   => date('Y-m-d H:i:s')
			]);
		}
	}
}
