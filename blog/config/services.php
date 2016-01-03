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
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'secret' => '',
	],

	'geo_code' => [
		'apiKey' => env('GEO_CODE_API_KEY', ''),
		'apiUrl' => env('GEO_CODE_API_URL', ''),
		'apiOutput' => 'json',
		'cacheDriver' => config('cache.default'),
		'cacheTime' => '30' // time in minutes
	]

];
