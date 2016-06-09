<?php

return [
	/*
	 |--------------------------------------------------------------------------
	 | Laravel CORS
	 |--------------------------------------------------------------------------
	 |
    
	 | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
	 | to accept any value.
	 |
	 */
	'supportsCredentials' => false,
	'allowedOrigins'      => ['*'],
	'allowedHeaders'      => ['Origin', 'Content-Type', 'Authorization'],
	'allowedMethods'      => ['GET', 'POST', 'PATCH', 'PUT', 'DELETE', 'OPTIONS'],
	'exposedHeaders'      => [],
	'maxAge'              => 0,
	'hosts'               => [],
];

