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
		\App\Http\Models\TareaEstatus::create([
			'id'      => 1,
			'estatus' => 'Asignado',
			'color'   => '#9A12B3',
			'class'   => 'purple-seance'
		]);
		
		\App\Http\Models\TareaEstatus::create([
			'id'      => 2,
			'estatus' => 'Reasignado',
			'color'   => '#C8D046',
			'class'   => 'yellow-soft'
		]);
		
		\App\Http\Models\TareaEstatus::create([
			'id'      => 3,
			'estatus' => 'Proceso',
			'color'   => '#26C281',
			'class'   => 'green-jungle'
		]);
		
		\App\Http\Models\TareaEstatus::create([
			'id'      => 4,
			'estatus' => 'Cerrado',
			'color'   => '#E9EDEF',
			'class'   => 'grey-steel'
		]);
		
		\App\Http\Models\TareaEstatus::create([
			'id'      => 5,
			'estatus' => 'Suspendido',
			'color'   => '#2F353B',
			'class'   => 'dark'
		]);
		
		\App\Http\Models\TareaEstatus::create([
			'id'      => 6,
			'estatus' => 'Cancelado',
			'color'   => '#D91E18',
			'class'   => 'red-thunderbird'
		]);
	}
}
