<?php

return [
	
	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/
	
	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
	],
	
	'ses' => [
		'key'    => env('SES_KEY'),
		'secret' => env('SES_SECRET'),
		'region' => 'us-east-1',
	],
	
	'sparkpost' => [
		'secret' => env('SPARKPOST_SECRET'),
	],
	
	'stripe' => [
		'model'  => \App\Http\Models\UserApp::class,
		'key'    => env('STRIPE_KEY'),
		'secret' => env('STRIPE_SECRET'),
	],
	
	'firebase' => [
		'api_key'        => 'AIzaSyAW9HLtzFbMjIcVC9kZaoXFp4AbH0m2bHM',
		'auth_domain'    => 'api-crm-f87c8.firebaseapp.com',
		'database_url'   => 'https://api-crm-f87c8.firebaseio.com',
		'secret'         => 'wPOfq3Xu9Vb8qPxLp0iiLiBAs0Ng4MvaErjvyHjv',
		'storage_bucket' => 'api-crm-f87c8.appspot.com',
	],

];
