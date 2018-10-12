<?php
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let's turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight these users.
|
*/

$app = require_once __DIR__.'/bootstrap/start.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can simply call the run method,
| which will execute the request and send the response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have whipped up for them.
|
*/
defined("CDN") or
    define('CDN',url('/').'/cdn/');
defined("'PROFILE_USER_ID") or
define('PROFILE_USER_ID','profile_user_id');

if(preg_match('/xampp/',$_SERVER['DOCUMENT_ROOT']))
{
	defined("CLIENT_DOMAIN") or define("CLIENT_DOMAIN",'client.marketplace');
	defined("FREELANCER_DOMAIN") or define("FREELANCER_DOMAIN",'freelancer.marketplace');

}else{

	defined("CLIENT_DOMAIN") or define("CLIENT_DOMAIN",'client.asianlancers.com');
	defined("FREELANCER_DOMAIN") or define("FREELANCER_DOMAIN",'freelancer.asianlancers.com');

}
$app->run();
