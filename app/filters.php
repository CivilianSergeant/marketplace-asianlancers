<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request) {
    //
});


App::after(function ($request, $response) {
    //
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

/*Route::filter('sample', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});*/

Route::filter('auth', function () {

    if (!Sentry::check()) {

        Session::put('rurl', Request::path());
        return Redirect::to('home/login');

    } else {

        // we can check authorization here
    }
});

Route::filter('admin', function () {

    try {

        // Find the user using the user id
        $user = Sentry::getUser();


        // Check if the user has the 'admin' permission. Also,
        // multiple permissions may be used by passing an array
        if (!empty($user)) {
            if (!$user->hasAccess('Admin')) {
                return Redirect::to('home/login')->withErrors(array("Admin Access Denied"));
            }
        }

    } catch (Cartalyst\Sentry\UserNotFoundException $e) {
        echo 'User was not found.';
    }
});


Route::filter('agency', function () {

    try {
        // Find the user using the user id
        $user = Sentry::getUser();

        // Check if the user has the 'admin' permission. Also,
        // multiple permissions may be used by passing an array
        if (!empty($user)) {
            if (!$user->hasAccess('Agency')) {
                return Redirect::to('home/login')->withErrors(array("Agency Access Denied"));
            }
        }
    } catch (Cartalyst\Sentry\UserNotFoundException $e) {
        echo 'User was not found.';
    }
});


Route::filter('freelancer', function () {

    try {
        // Find the user using the user id
        $user = Sentry::getUser();

        // Check if the user has the 'admin' permission. Also,
        // multiple permissions may be used by passing an array
        if (!empty($user)) {
            if (!$user->hasAccess('Individual') && (!$user->hasAccess('Agency')) && (!$user->hasAccess('Admin'))) {
                return Redirect::to('home/login')->withErrors(array("Freelancer Access Denied"));
            }
        }
    } catch (Cartalyst\Sentry\UserNotFoundException $e) {
        echo 'User was not found.';
    }
});

Route::filter('client', function () {

    try {
        // die();
        // Find the user using the user id
        $user = Sentry::getUser();

        // Check if the user has the 'admin' permission. Also,
        // multiple permissions may be used by passing an array
        if (!empty($user)) {
            if (!$user->hasAccess('Client')) {
                return Redirect::to('home/login')->withErrors(array("Client Access Denied"));
            }
        }

    } catch (Cartalyst\Sentry\UserNotFoundException $e) {
        echo 'User was not found.';
    }
});


Route::filter('auth.basic', function () {
    return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function () {
    if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function () {
    if (Session::token() != Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException;
    }
});
