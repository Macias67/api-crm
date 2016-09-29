<?php

use Illuminate\Database\Seeder;

class OficinasSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();
		
		\App\Http\Models\Oficinas::create([
			'calle'      => $faker->streetName,
			'numero'     => $faker->buildingNumber,
			'colonia'    => $faker->cityPrefix,
			'cp'         => $faker->postcode,
			'ciudad'     => $faker->city,
			'estado'     => $faker->state,
			'latitud'    => $faker->latitude,
			'longitud'   => $faker->longitude,
			'telefonos'  => $faker->tollFreePhoneNumber,
			'email'      => $faker->email
		]);
	}
}
