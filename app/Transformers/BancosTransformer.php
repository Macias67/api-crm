<?php
/**
 * User: Luis
 * Date: 08/07/2016
 * Time: 09:31 PM
 */
namespace App\Transformers;

use App\Http\Models\Bancos;
use League\Fractal\TransformerAbstract;

class BancosTransformer extends TransformerAbstract
{
	public function transform(Bancos $banco)
	{
		$data = [
			'id'         => $banco->id,
			'banco'      => $banco->banco,
			'sucursal'   => $banco->sucursal,
			'cta'        => $banco->cta,
			'titular'    => $banco->titular,
			'cib'        => $banco->cib,
			'created_at' => $banco->created_at,
			'updated_at' => $banco->updated_at
		];
		
		return $data;
	}
}