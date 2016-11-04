<?php
/**
 * User: Luis
 * Date: 03/11/2016
 * Time: 02:57 PM
 */

namespace App\Transformers;


use App\Http\Models\Nota;
use League\Fractal\TransformerAbstract;

class NotaTransformer extends TransformerAbstract
{
	public function transform(Nota $nota)
	{
		$archivos = [];
		$dArchivos = $nota->archivos;
		foreach ($dArchivos as $index => $dArchivo)
		{
			$archivos[$index] = [
				'id'          => $dArchivo->id,
				'downloadUrl' => $dArchivo->download_url,
				'contentType' => $dArchivo->content_type,
				'path'        => $dArchivo->full_path,
				'md5hash'     => $dArchivo->md5hash,
				'nombre'      => $dArchivo->name,
				'tamano'      => $dArchivo->size,
				'creado'      => $dArchivo->created_at->getTimestamp()
			];
		}
		
		$data = [
			'id'          => $nota->id,
			'nota'        => $nota->nota,
			'publico'     => $nota->publico,
			'avance'      => $nota->avance,
			'habilitado'  => $nota->habilitado,
			'archivos'    => $archivos,
			'creada'      => $nota->created_at->getTimestamp(),
			'actualizada' => $nota->updated_at->getTimestamp()
		];
		
		return $data;
	}
}