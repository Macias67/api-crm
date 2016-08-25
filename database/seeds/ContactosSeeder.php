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
		
		DB::table('cl_contactos')->insert([
			'id_cliente' => 1,
			'nombre'     => 'Luis',
			'apellido'   => 'Macias',
			'email'      => 'luismacias.angulo@gmail.com',
			'password'   => bcrypt('qwerty'),
			'telefono'   => '3929418119',
			'online'     => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
		
		for ($i = 0; $i < 15; $i++)
		{
			DB::table('cl_contactos')->insert([
				'id_cliente' => rand(1, 10),
				'nombre'     => 'Luis',
				'apellido'   => 'Macias',
				'email'      => 'luismacias.angulo@gmail.com',
				'password'   => bcrypt('qwerty'),
				'telefono'   => '3929418119',
				'online'     => 1,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
				
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
