<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(\App\Http\Models\Clientes::class, function (Faker\Generator $faker)
{
	$prospecto = $faker->randomElement([0, 1]);
	
	return [
		'razonsocial'  => mb_strtoupper($faker->company),
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
	];
});
