<?php

return array(

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

	'mailgun' => array(
		'domain' => '',
		'secret' => '',
	),

    // mail apikey set to mandrill - Tanvir.
	'mandrill' => array(
		'secret' => 'fw4jIWBntIyZ6IeRA1yOwg',
	),

	'stripe' => array(
		'model'  => 'User',
		'secret' => '',
	),

);
