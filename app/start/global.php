<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/custom-library',
	app_path().'/custom-library/Exceptions',
	app_path().'/custom-library/ExcelReader',
	app_path().'/custom-library/FPDF',
	app_path().'/models',
	app_path().'/models/Admin',
	app_path().'/models/Client',
    app_path().'/models/Client/Validators',
	app_path().'/models/Comment',
	app_path().'/models/Internalmsg',
	app_path().'/models/Feedback',
	app_path().'/models/Freelancer',
	app_path().'/models/Freelancer/Validators',
	app_path().'/models/Job',
	app_path().'/models/Notification',
	app_path().'/models/Payment',
	app_path().'/models/Page',
	app_path().'/models/Question',
	app_path().'/models/Question/Validators',
	app_path().'/models/Tag',
	app_path().'/models/Tag/Validators',
    app_path().'/models/Test',
    app_path().'/models/Job/Validators',

	app_path().'/database/seeds',
    app_path().'/models/Authenticate/Validators',
    app_path().'/models/Authenticate',
    app_path().'/custom-library/PayPal',
    app_path().'/custom-library/PayPal/Api',
    app_path().'/custom-library/PayPal/Auth',
    app_path().'/custom-library/PayPal/Auth/Oauth',
    app_path().'/custom-library/PayPal/Auth/Openid',
    app_path().'/custom-library/PayPal/Common',
    app_path().'/custom-library/PayPal/Core',
    app_path().'/custom-library/PayPal/Exception',
    app_path().'/custom-library/PayPal/Formatter',
    app_path().'/custom-library/PayPal/Handler',
    app_path().'/custom-library/PayPal/IPN',
    app_path().'/custom-library/PayPal/Rest',
    app_path().'/custom-library/PayPal/Transport',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog custom-library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';
