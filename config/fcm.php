<?php

return [
	'driver'      => env('FCM_PROTOCOL', 'http'),
	'log_enabled' => true,
	
	'http' => [
		'server_key'       => env('FCM_SERVER_KEY', 'AIzaSyDZCn6COPYtza-_kVSrmMWV7NcILTlvwyk'),
		'sender_id'        => env('FCM_SENDER_ID', '738619244670'),
		'server_send_url'  => 'https://fcm.googleapis.com/fcm/send',
		'server_group_url' => 'https://android.googleapis.com/gcm/notification',
		'timeout'          => 5.0, // in second
	]
];
