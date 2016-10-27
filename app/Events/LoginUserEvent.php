<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class LoginUserEvent extends Event
{
	use SerializesModels;
	
	/**
	 * The authenticated user.
	 *
	 * @var \App\Http\Models\UserApp $user
	 */
	public $user;
	
	/**
	 * Create a new event instance.
	 *
	 * @param $user
	 */
	public function __construct($user)
	{
		$this->user = $user;
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
