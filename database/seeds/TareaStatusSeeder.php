<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TareaStatusSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('cs_tarea_estatus')->insert([
			'id'      => 1,
			'estatus' => 'Asignado',
			'color'   => '#9A12B3',
			'class'   => 'purple-seance'
		]);
		
		DB::table('cs_tarea_estatus')->insert([
			'id'      => 2,
			'estatus' => 'Reasignado',
			'color'   => '#C8D046',
			'class'   => 'yellow-soft'
		]);
		
		DB::table('cs_tarea_estatus')->insert([
			'id'      => 3,
			'estatus' => 'Proceso',
			'color'   => '#26C281',
			'class'   => 'green-jungle'
		]);
		
		DB::table('cs_tarea_estatus')->insert([
			'id'      => 4,
			'estatus' => 'Cerrado',
			'color'   => '#E9EDEF',
			'class'   => 'grey-steel'
		]);
		
		DB::table('cs_tarea_estatus')->insert([
			'id'      => 5,
			'estatus' => 'Suspendido',
			'color'   => '#2F353B',
			'class'   => 'dark'
		]);
		
		DB::table('cs_tarea_estatus')->insert([
			'id'      => 6,
			'estatus' => 'Cancelado',
			'color'   => '#D91E18',
			'class'   => 'red-thunderbird'
		]);
	}
}
