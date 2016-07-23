<?php
/**
 * User: Luis
 * Date: 22/07/2016
 * Time: 12:01 PM
 */

namespace Transformers;

use App\Http\Models\Cotizacion;
use League\Fractal\TransformerAbstract;

class CotizacionTransformer extends TransformerAbstract
{
	public function transform(Cotizacion $cotizacion)
	{
		$data = [
			
		];
		
		return $data;
	}
}