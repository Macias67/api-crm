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
		
		\App\Http\Models\Clientes::create([
			'razonsocial'  => 'EMPRESA DE MACIAS',
			'rfc'          => 'AAA000AAAA123',
			'prospecto'    => 0,
			'distribuidor' => 1,
			'email'        => 'luismacias.angulo@gmail.com',
			'telefono'     => '3929418119',
			'telefono2'    => '',
			'calle'        => 'Sócrates',
			'noexterior'   => '244',
			'nointerior'   => '',
			'colonia'      => 'Paso Blanco',
			'cp'           => '47810',
			'ciudad'       => 'Ocotlán',
			'municipio'    => '',
			'estado'       => 'Jalisco',
			'pais'         => 'México',
			'online'       => 1,
		]);
		
		for ($i = 0; $i < 10; $i++)
		{
			\App\Http\Models\Clientes::create([
				'razonsocial'  => mb_strtoupper($faker->company),
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
