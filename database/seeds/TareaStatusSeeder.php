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
			'color'   => '#3FABA4',
			'class'   => 'bg-green-soft bg-font-green-soft'
		]);
		
		DB::table('cs_tarea_estatus')->insert([
			'id'      => 2,
			'estatus' => 'Reasignado',
			'color'   => '#C8D046',
			'class'   => 'bg-yellow-soft bg-font-yellow-soft'
		]);
		
		DB::table('cs_tarea_estatus')->insert([
			'id'      => 3,
			'estatus' => 'Proceso',
			'color'   => '#26C281',
			'class'   => 'bg-green-jungle bg-font-green-jungle'
		]);
		
		DB::table('cs_tarea_estatus')->insert([
			'id'      => 4,
			'estatus' => 'Cerrado',
			'color'   => '#E9EDEF',
			'class'   => 'bg-grey-steel bg-font-grey-steel'
		]);
		
		DB::table('cs_tarea_estatus')->insert([
			'id'      => 5,
			'estatus' => 'Suspendido',
			'color'   => '#2F353B',
			'class'   => 'bg-dark bg-font-dark'
		]);
		
		DB::table('cs_tarea_estatus')->insert([
			'id'      => 6,
			'estatus' => 'Cancelado',
			'color'   => '#D91E18',
			'class'   => 'bg-red-thunderbird bg-font-red-thunderbird'
		]);
	}
}
