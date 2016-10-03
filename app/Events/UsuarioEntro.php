<?php

namespace App\Events;

use App\Http\Models\UserApp;
use Illuminate\Queue\SerializesModels;

class UsuarioEntro extends Event
{
	use SerializesModels;
	
	public $usuario;
	
	/**
	 * Create a new event instance.
	 *
	 * @param \App\Http\Models\UserApp $userApp
	 */
	public function __construct(UserApp $userApp)
	{
		$this->usuario = $userApp;
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
