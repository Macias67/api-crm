<?php

use Illuminate\Database\Seeder;

class PermisosSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\App\Http\Models\Permisos::create([
			'name'         => 'vistaEjecutivo',
			'display_name' => 'Vista Ejecutivo',
			'description'  => 'Acceso a vistas de Ejecutivo',
		]);
		
		\App\Http\Models\Permisos::create([
			'name'         => 'vistaCliente',
			'display_name' => 'Vista Cliente',
			'description'  => 'Acceso a vistas de Cliente',
		]);
	}
}
