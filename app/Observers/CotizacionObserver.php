<?php
/**
 * User: Luis
 * Date: 26/10/2016
 * Time: 07:22 PM
 */

namespace App\Observers;

use App\Http\Models\Cotizacion;
use App\Http\Models\CotizacionEstatus;
use Firebase\FirebaseLib;

class CotizacionObserver
{
	const PARENT = 'cotizacion';
	private $firebaseClient;
	
	/**
	 * CotizacionObserver constructor.
	 *
	 */
	public function __construct()
	{
		$this->firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
	}
	
	
	/**
	 * Listen to the User created event.
	 *
	 * @param \App\Http\Models\Cotizacion $cotizacion
	 */
	public function created(Cotizacion $cotizacion)
	{
		
		if ($cotizacion->estatus->id == CotizacionEstatus::PORPAGAR)
		{
			if (is_null($this->firebaseClient))
			{
				$this->firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
			}
			
			$child = 'porpagar';
			
			$path = self::PARENT . '/' . $child;
			
			$cotizacion = $cotizacion->fresh();
			$data = [
				'id'        => $cotizacion->id,
				'cliente'   => $cotizacion->cliente->razonsocial,
				'ejecutivo' => $cotizacion->ejecutivo->usuario->nombreCompleto(),
				'creado'    => $cotizacion->created_at->getTimestamp(),
			]
			;
			$this->firebaseClient->push($path, $data);
		}
		
	}
}