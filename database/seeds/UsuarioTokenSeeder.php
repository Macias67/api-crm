<?php

use Illuminate\Database\Seeder;

class UsuarioTokenSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//du2VntC0kh0:APA91bHK-snT0_glA4-7ef3HTdCKKIO5Dwg8fzcVDWIgbbWXHQpOyu3D_f9AMJt_diDw9KTO3YOjqpcC6oMd97YKT-7UzYfesoo2XF90kh-x6bOvhW4OcmO0WLfyXHeDQLSY2VgUmxSh
		
		\App\Http\Models\UsuarioTokens::create([
			'id'         => 1,
			'id_usuario' => 1,
			'token'      => 'du2VntC0kh0:APA91bHK-snT0_glA4-7ef3HTdCKKIO5Dwg8fzcVDWIgbbWXHQpOyu3D_f9AMJt_diDw9KTO3YOjqpcC6oMd97YKT-7UzYfesoo2XF90kh-x6bOvhW4OcmO0WLfyXHeDQLSY2VgUmxSh',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		]);
		
	}
}
