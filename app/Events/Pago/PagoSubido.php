<?php

namespace App\Events\Pago;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class PagoSubido extends Event
{
	use SerializesModels;
	
	/**
	 * @var \App\Http\Models\CotizacionPagos $pago
	 */
	public $pago;
	
	/**
	 * Create a new event instance.
	 *
	 * @param  \App\Http\Models\CotizacionPagos $pago
	 */
	public function __construct($pago)
	{
		$this->pago = $pago;
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
