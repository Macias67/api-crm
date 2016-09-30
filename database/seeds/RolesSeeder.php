<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\App\Http\Models\Roles::create([
			'name'         => 'EJECUTVO',
			'display_name' => 'Acceso a funciones de Ejecutivo',
			'description'  => 'Acceso a funciones de Ejecutivo'
		]);
		
		\App\Http\Models\Roles::create([
			'name'         => 'CLIENTE',
			'display_name' => 'Acceso a funciones de Cliente',
			'description'  => 'Acceso a funciones de Cliente'
		]);
		
		DB::table('ec_permisos_roles')->insert([
			'permission_id' => 1,
			'role_id' => 1,
		]);
		
		DB::table('ec_permisos_roles')->insert([
			'permission_id' => 2,
			'role_id' => 2,
		]);
		
		DB::table('ec_roles_user')->insert([
			'user_id' => 1,
			'role_id' => 1,
		]);
		
		DB::table('ec_roles_user')->insert([
			'user_id' => 4,
			'role_id' => 2,
		]);
	}
}
