<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', "HomeController@index");
Route::any('home/login',"HomeController@login");
Route::any('home/logout',"HomeController@logout");
Route::any('home/sign-up',"HomeController@signUp");
Route::any('home/sign-up-client',"HomeController@signUpClient");
Route::any('home/sign-up-freelancer',"HomeController@signUpFreelancer");
Route::any('home/price/{cid?}',"HomeController@price");
Route::any('home/forget',"HomeController@ForgetPasswordView");
Route::any('home/reset/{id?}/{code?}',"HomeController@RestPassword");
Route::any('search/freelancer/{cid?}',"SearchController@Freelancer");
Route::any('search/freelancers-list',"SearchController@FreelancersList");
Route::any('search/new-freelancers-list',"SearchController@NewFreelancersList");
Route::get('home/activate/{idx?}/{code?}/{type?}/{company?}',"HomeController@activate");
Route::any('home/set-page-flag','HomeController@SetPageFlag');
Route::any('home/set-lang','HomeController@setLang');
//route::any('test/cg/{group}',"testcontroller@creategroup");
Route::any('test/{ex?}',"TestController@CustomException");
Route::any('test/fd',"TestController@FindData");

Route::any('search/jobs/{category?}/{searchtxt?}/{price?}/{page?}','SearchController@jobs');
Route::any('view/client/{id?}','ViewController@client');
Route::any('view/job/{category?}/{job_id?}','ViewController@job');
Route::any('view/freelancer/{id?}','ViewController@freelancer');
Route::any('view/page/{url}','ViewController@page');
Route::any('/favicon.ico','HomeController@login');
Route::any('job-apply','ApplyJobController@index');

Route::group(array('before'=>'auth'),function(){

    /**
     * hasAcces filter (permissions)
     *
     * Check if the user has permission (group/user)
     */

    Route::when('skill/*','admin');
    Route::when('admin/*','admin');
    Route::when('qbuilder/*','admin');
    Route::when('jobcategory/*','admin');

    Route::when('freelancer/*','freelancer');
    Route::when('agency/*','agency');
//    Route::when('client/*','client');
    Route::any('message/details/{discussion_id?}/{id?}','MessageController@details');

    Route::any('jobcategory', 'JobCategoryController@index');
    Route::any('jobcategory/add', 'JobCategoryController@add');
    Route::any('jobcategory/update-display', 'JobCategoryController@UpdateDisplay');
    Route::any('jobcategory/permanent-delete', 'JobCategoryController@PermanentDelete');
    Route::any('jobcategory/delete', 'JobCategoryController@Delete');

    Route::any('jobpricecategory', 'JobPriceCategoryController@index');
    Route::any('jobpricecategory/add', 'JobPriceCategoryController@add');
    Route::any('jobpricecategory/update-display', 'JobPriceCategoryController@UpdateDisplay');
    Route::any('jobpricecategory/permanent-delete', 'JobPriceCategoryController@PermanentDelete');
    Route::any('jobpricecategory/delete', 'JobPriceCategoryController@Delete');

    
    // Dynamic Routing with a common pattern
    Route::any('{controller}/{action?}/{args?}', function($controller, $action = 'index', $args = '' )
    {

        $cont = "Controller";
        $notFound = "NotFound";
        $params = explode("/", $args);
        $app = app();

        $controllerName = $controller;

        $controller = ucfirst($controller);				// added this line for resolving file name problem in linux hosting

        if (!class_exists($controller.$cont)) {

            $controller = $notFound;
            $action = 'index';
        }

        $controller = $app->make($controller.$cont);

        $method = str_replace("-","",$action);
        if(!method_exists($controller,$method))
        {
            $controller = $notFound;
            $method = 'index';
            $controller = $app->make($controller.$cont);
        }
        Menu::setUri($controllerName.'/'.$action.'/'.$args);
        return $controller->callAction($method, $params);

    })->where(array(
            'controller' => '[^/]+',
            'action' => '[^/]+',
          //  'args' => '[^?$]+'
    ));


});