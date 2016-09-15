<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasoStatusSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('cs_caso_estatus')->insert([
			'id'      => 1,
			'estatus' => 'Por Asignar',
			'color'   => '#F3C200',
			'class'   => 'yellow-crusta'
		]);
		
		DB::table('cs_caso_estatus')->insert([
			'id'      => 2,
			'estatus' => 'Asignado',
			'color'   => '#3FABA4',
			'class'   => 'green-soft'
		]);
		
		DB::table('cs_caso_estatus')->insert([
			'id'      => 3,
			'estatus' => 'Reasignado',
			'color'   => '#C8D046',
			'class'   => 'yellow-soft'
		]);
		
		DB::table('cs_caso_estatus')->insert([
			'id'      => 4,
			'estatus' => 'Proceso',
			'color'   => '#26C281',
			'class'   => 'green-jungle'
		]);
		
		DB::table('cs_caso_estatus')->insert([
			'id'      => 5,
			'estatus' => 'Precierre',
			'color'   => '#32C5D2',
			'class'   => 'green'
		]);
		
		DB::table('cs_caso_estatus')->insert([
			'id'      => 6,
			'estatus' => 'Cerrado',
			'color'   => '#E9EDEF',
			'class'   => 'grey-steel'
		]);
		
		DB::table('cs_caso_estatus')->insert([
			'id'      => 7,
			'estatus' => 'Suspendido',
			'color'   => '#2F353B',
			'class'   => 'dark'
		]);
		
		DB::table('cs_caso_estatus')->insert([
			'id'      => 8,
			'estatus' => 'Cancelado',
			'color'   => '#D91E18',
			'class'   => 'red-thunderbird'
		]);
	}
}
