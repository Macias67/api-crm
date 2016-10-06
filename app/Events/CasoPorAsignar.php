<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class CasoPorAsignar extends Event
{
	use SerializesModels;
	
	public $cliente;
	
	/**
	 * Create a new event instance.
	 *
	 * @param $cliente
	 */
	public function __construct($cliente)
	{
		$this->cliente = $cliente;
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
