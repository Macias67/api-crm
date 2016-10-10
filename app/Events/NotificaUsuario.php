<?php

namespace App\Events;

use App\Http\Models\FBNotification;
use Illuminate\Queue\SerializesModels;

class NotificaUsuario extends Event
{
	use SerializesModels;
	
	public $notificacion;
	
	/**
	 * Create a new event instance.
	 *
	 * @param \App\Http\Models\FBNotification $notification
	 */
	public function __construct(FBNotification $notification)
	{
		$this->notificacion = $notification;
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
