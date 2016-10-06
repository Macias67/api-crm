<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CotizacionPagosSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\App\Http\Models\CotizacionPagos::create([
			'id'            => 1,
			'cotizacion_id' => 1,
			'contacto_id'   => 4,
			'cantidad'      => 6380,
			'tipo'      => 'total',
			'comentario'    => 'Copia comprobante pago',
			'valido'        => 0,
		]);
	}
}
