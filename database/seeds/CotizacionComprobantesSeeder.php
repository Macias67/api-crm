<?php

use Illuminate\Database\Seeder;

class CotizacionComprobantesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\App\Http\Models\CotizacionComprobantes::create([
			'id'           => 1,
			'pago_id'      => 1,
			'download_url' => '',
			'content_type' => '',
			'full_path'    => '',
			'md5hash'      => '',
			'name'         => '',
			'size'         => '',
		]);
	}
}
