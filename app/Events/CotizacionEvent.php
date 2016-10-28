<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class CotizacionEvent extends Event
{
	use SerializesModels;
	
	/**
	 * @var \App\Http\Models\Cotizacion $cotizacion
	 */
	public $cotizacion;
	
	/**
	 * Create a new event instance.
	 *
	 * @param \App\Http\Models\Cotizacion $cotizacion
	 */
	public function __construct($cotizacion)
	{
		$this->cotizacion = $cotizacion;
	}
	
	/**
	 * Get the channels the event should be broadcast on.
	 *
	 * @return array
	 */
	public function broadcastOn()
	{
		return [];
	}
}
