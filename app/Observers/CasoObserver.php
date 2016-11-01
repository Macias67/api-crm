<?php
/**
 * User: Luis Macias
 * Date: 28/10/2016
 * Time: 12:51 AM
 */

namespace App\Observers;

use App\Http\Models\Caso;
use App\Http\Models\CasoEstatus;
use Firebase\FirebaseLib;

class CasoObserver
{
	const PARENT = 'caso';
	
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
	 * CasoObserver constructor.
	 *
	 */
	public function __construct()
	{
		$this->firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
	}
	
	/**
	 * Listen to the Caso created event.
	 *
	 * @param \App\Http\Models\Caso $caso
	 *
	 */
	public function created(Caso $caso)
	{
		$data = $this->defineData($caso);
		
		$this->firebaseClient->set($this->path, $data);
	}
	
	/**
	 * Listen to the Caso updated event.
	 *
	 * @param \App\Http\Models\Caso $caso
	 *
	 */
	public function updated(Caso $caso)
	{
		$data = $this->defineData($caso);
		
		$this->firebaseClient->update($this->path, $data);
	}
	
	/**
	 * Define los datos para guardar datos en la BD de Firebase
	 *
	 * @param \App\Http\Models\Caso $caso
	 *
	 * @return array
	 */
	private function defineData(Caso $caso)
	{
		switch ($caso->estatus->id)
		{
			case CasoEstatus::PORASIGNAR:
				$this->estatus = 'porasignar';
				break;
			case CasoEstatus::ASIGNADO:
				$this->estatus = 'asignado';
				break;
			case CasoEstatus::REASIGNADO:
				$this->estatus = 'reasignado';
				break;
			case CasoEstatus::PROCESO:
				$this->estatus = 'proceso';
				break;
			case CasoEstatus::PRECIERRE:
				$this->estatus = 'precierre';
				break;
			case CasoEstatus::CERRADO:
				$this->estatus = 'cerrado';
				break;
			case CasoEstatus::SUSPENDIDO:
				$this->estatus = 'suspendido';
				break;
			default:
				$this->estatus = 'cancelado';
				break;
		}
		
		if (is_null($this->firebaseClient))
		{
			$this->firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
		}
		
		$this->path = self::PARENT . '/' . $caso->getKey();
		
		$caso = $caso->fresh();
		
		$data = [
			'idCliente'   => $caso->cliente->id,
			'razonsocial' => $caso->cliente->razonsocial,
			'estatus'     => $this->estatus,
			'creado'      => $caso->created_at->getTimestamp(),
		];
		
		if ($caso->estatus->id != CasoEstatus::PORASIGNAR)
		{
			$data['idLider'] = $caso->casoLider->lider->id;
			$data['lider'] = $caso->casoLider->lider->usuario->nombreCompleto();
		}
		
		return $data;
	}
}