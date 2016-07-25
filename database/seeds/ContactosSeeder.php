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
	}
}
