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

Route::get('/', function()
{
	//$find_people_list = FindPeople::all();
	$find_people_list = FindPeople::orderBy('created_at','dsc')->get();
	return View::make('home',['find_people_list' => $find_people_list]);
});

Route::post('/', array(
    'as' => 'find.people.create',
    'uses' => 'FindPeopleController@create'
) );

Route::get('/laravel', function()
{
	return View::make('hello');
});

Route::get('/env', function()
{
	var_dump( App::environment() );
	return;
});

Route::get('/env-all', function()
{
	var_dump($_SERVER); // array of all php server vars
	return;
});

Route::get('/hostname', function()
{
	var_dump( gethostname() );
});

Route::get('/dbtest', function()
{
	$findPeople = DB::table('find-people')->get();
	return $findPeople;
});
