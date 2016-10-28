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
	
	/**
	 * @var \Firebase\FirebaseLib $firebaseClient
	 */
	private $firebaseClient;
	
	/**
	 * @var string
	 */
	private $estatus;
	
	/**
	 * @var string
	 */
	private $path;
	
	/**
	 * CotizacionObserver constructor.
	 *
	 */
	public function __construct()
	{
		$this->firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
	}
	
	/**
	 * Listen to the Cotizacion created event.
	 *
	 * @param \App\Http\Models\Cotizacion $cotizacion
	 */
	public function created(Cotizacion $cotizacion)
	{
		$data = $this->defineData($cotizacion);
		
		$this->firebaseClient->set($this->path, $data);
	}
	
	/**
	 * Listen to the Cotizacion updated event.
	 *
	 * @param \App\Http\Models\Cotizacion $cotizacion
	 */
	public function updated(Cotizacion $cotizacion)
	{
		$data = $this->defineData($cotizacion);
		
		$this->firebaseClient->update($this->path, $data);
	}
	
	/**
	 * Define los datos para guardar datos en la BD de Firebase
	 *
	 * @param \App\Http\Models\Cotizacion $cotizacion
	 *
	 * @return array
	 */
	private function defineData(Cotizacion $cotizacion)
	{
		switch ($cotizacion->estatus->id)
		{
			case CotizacionEstatus::PORPAGAR:
				$this->estatus = 'porpagar';
				break;
			case CotizacionEstatus::REVISION:
				$this->estatus = 'revision';
				break;
			case CotizacionEstatus::IRREGULAR:
				$this->estatus = 'irregular';
				break;
			case CotizacionEstatus::PAGADA:
				$this->estatus = 'pagada';
				break;
			case CotizacionEstatus::ABONADA:
				$this->estatus = 'abonada';
				break;
			case CotizacionEstatus::VENCIDA:
				$this->estatus = 'vencida';
				break;
			default:
				$this->estatus = 'cancelada';
				break;
		}
		
		if (is_null($this->firebaseClient))
		{
			$this->firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
		}
		
		$this->path = self::PARENT . '/' . $cotizacion->getKey();
		
		$cotizacion = $cotizacion->fresh();
		
		$data = [
			'idCliente'   => $cotizacion->cliente->id,
			'idEjecutivo' => $cotizacion->ejecutivo->id,
			'razonsocial' => $cotizacion->cliente->razonsocial,
			'estatus'     => $this->estatus,
			'creado'      => $cotizacion->created_at->getTimestamp(),
		];
		
		return $data;
	}
}