<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAppSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();
		
		\App\Http\Models\UserApp::create([
			'id' => 1,
			'nombre'          => 'Luis',
			'apellido'        => 'Macias',
			'ejecutivo'          => 1,
			'avatar'          => 'default.jpg',
			'activo'          => 1,
			'email'           => 'luismacias.angulo@gmail.com',
			'password'        => bcrypt('secret'),
			'created_at'      => date('Y-m-d H:i:s'),
			'updated_at'      => date('Y-m-d H:i:s'),
		]);
		
		\App\Http\Models\UserApp::create([
			'id' => 2,
			'nombre'          => 'Eleazar',
			'apellido'        => 'Frías',
			'ejecutivo'          => 1,
			'avatar'          => 'default.jpg',
			'activo'          => 1,
			'email'           => 'eleazar.frias@gmail.com',
			'password'        => bcrypt('secret'),
			'created_at'      => date('Y-m-d H:i:s'),
			'updated_at'      => date('Y-m-d H:i:s'),
		]);
		
		\App\Http\Models\UserApp::create([
			'id' => 3,
			'nombre'          => 'Gloria',
			'apellido'        => 'Camarena',
			'ejecutivo'          => 1,
			'avatar'          => 'default.jpg',
			'activo'          => 1,
			'email'           => 'gloria.camarena@gmail.com',
			'password'        => bcrypt('secret'),
			'created_at'      => date('Y-m-d H:i:s'),
			'updated_at'      => date('Y-m-d H:i:s'),
		]);
		
		/**
		 * Contactos
		 */
		\App\Http\Models\UserApp::create([
			'id' => 4,
			'nombre'     => 'Luis',
			'apellido'   => 'Macias',
			'ejecutivo'          => 0,
			'avatar'          => 'default.jpg',
			'activo'          => 1,
			'email'      => 'luismacias@gmail.com',
			'password'   => bcrypt('qwerty'),
			'created_at'      => date('Y-m-d H:i:s'),
			'updated_at'      => date('Y-m-d H:i:s'),
		]);
		
		for ($i = 4; $i < 19; $i++)
		{
			\App\Http\Models\UserApp::create([
				'id' => ($i + 1),
				'nombre'     => $faker->name,
				'apellido'   => $faker->lastName,
				'ejecutivo'          => 0,
				'avatar'          => 'default.jpg',
				'activo'          => 1,
				'email'      => $faker->safeEmail,
				'password'   => bcrypt('qwerty'),
				'created_at'      => date('Y-m-d H:i:s'),
				'updated_at'      => date('Y-m-d H:i:s'),
			]);
		}
	}
}
