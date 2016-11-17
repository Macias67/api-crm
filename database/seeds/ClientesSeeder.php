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
		
		$cliente = \App\Http\Models\Clientes::create([
			'razonsocial'  => 'EMPRESA DE MACIAS',
			'rfc'          => 'AAA000AAAA123',
			'prospecto'    => 0,
			'distribuidor' => 0,
			'email'        => 'luismacias.angulo@gmail.com',
			'telefono'     => '3929418119',
			'telefono2'    => null,
			'calle'        => 'Sócrates',
			'noexterior'   => '244',
			'nointerior'   => null,
			'colonia'      => 'Paso Blanco',
			'cp'           => '47810',
			'ciudad'       => 'Ocotlán',
			'municipio'    => null,
			'estado'       => 'Jalisco',
			'pais'         => 'México',
			'online'       => 1,
		]);
		
		$cliente->registro()->create([
			'id_ejecutivo' => 1
		]);
		
		for ($i = 0; $i < 2500; $i++)
		{
			$prospecto = $faker->randomElement([0, 1]);
			
			$cliente = \App\Http\Models\Clientes::create([
				'razonsocial'  => mb_strtoupper($faker->company).$faker->randomLetter.date('s'),
				'rfc'          => mb_strtoupper(substr($faker->md5, 0, 13)),
				'prospecto'    => $prospecto,
				'distribuidor' => ($prospecto) ? 0 : $faker->randomElement([0, 1]),
				'email'        => $faker->safeEmail,
				'telefono'     => $faker->randomNumber(9) . $faker->randomNumber(1),
				'telefono2'    => null,
				'calle'        => $faker->streetName,
				'noexterior'   => $faker->buildingNumber,
				'nointerior'   => null,
				'colonia'      => $faker->cityPrefix,
				'cp'           => $faker->postcode,
				'ciudad'       => $faker->city,
				'municipio'    => null,
				'estado'       => $faker->state,
				'pais'         => 'México',
				'online'       => 1,
				'created_at'   => date('Y-m-d H:i:s'),
				'updated_at'   => date('Y-m-d H:i:s')
			]);
			
			$cliente->registro()->create([
				'id_ejecutivo' => $faker->numberBetween(1, 3)
			]);
		}
	}
}
