<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class ContactoSubePago extends Event
{
	use SerializesModels;
	
	public $contacto;
	
	/**
	 * Create a new event instance.
	 *
	 * @param $contacto
	 */
	public function __construct($contacto)
	{
		$this->contacto = $contacto;
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
