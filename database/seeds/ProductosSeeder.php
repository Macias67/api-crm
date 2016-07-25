<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('ec_productos')->insert([
			'codigo'      => 'ADM',
			'producto'    => 'ADMINPAQ',
			'descripcion' => 'Sistema ADMINPAQ última versión',
			'id_unidad'   => 1,
			'precio'      => 5500,
			'online'      => 1,
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')
		]);
		
		DB::table('ec_productos')->insert([
			'codigo'      => 'FAC',
			'producto'    => 'CONTPAQi FACTURA ELECTRÓNICA',
			'descripcion' => 'Sistema FACTURA ELECTRÓNICA última versión',
			'id_unidad'   => 1,
			'precio'      => 2300,
			'online'      => 1,
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')
		]);
		
		DB::table('ec_productos')->insert([
			'codigo'      => 'CNOM',
			'producto'    => 'CONTPAQi NÓMINAS',
			'descripcion' => 'Sistema NÓMINAS última versión',
			'id_unidad'   => 1,
			'precio'      => 4300,
			'online'      => 1,
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')
		]);
	}
}
