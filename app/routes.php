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

// Route::get('/', function()
// {
// 	$found_people_list = FoundPeople::orderBy('created_at','dsc')->get();
// 	$find_people_list = FindPeople::orderBy('created_at','dsc')->get();
// 	return View::make('home',[ 'found_people_list' => $found_people_list, 
// 							   'find_people_list' => $find_people_list  
// 							 ]);
// });

Route::get('/', array(
    'as' => 'home',
    'uses' => function()
				{
					// if ( Auth::check() ) {
					// 	return Redirect::route('dashboard');
					// }

					return Redirect::route('howto');
				}
) );

Route::get('/howto', array(
    'as' => 'howto',
    'uses' => function()
				{
					return View::make('howto');
				}
) );

Route::get('/about', array(
    'as' => 'about',
    'uses' => function()
				{
					return View::make('about');
				}
) );

Route::get('/findandfound', array(
    'as' => 'find.and.found',
    'uses' => function()
				{
					$found_people_list = FoundPeople::orderBy('created_at','dsc')->get();
					$find_people_list = FindPeople::orderBy('created_at','dsc')->get();
					return View::make('home',[ 'found_people_list' => $found_people_list, 
											   'find_people_list' => $find_people_list  
											 ]);
				}
) );

Route::post('/find', array(
    'as' => 'find.people.create',
    'uses' => 'FindPeopleController@create'
) );

Route::post('deletefip', array(
    'as' => 'find.people.delete',
    'uses' => 'FindPeopleController@delete'
) );

Route::post('/found', array(
    'as' => 'found.people.create',
    'uses' => 'FoundPeopleController@create'
) );

Route::get('/updates', array(
    'as' => 'updates',
    'uses' => function()
				{
					$army_updates_pag = ArmyUpdates::orderBy('s_no','asc')->paginate(5);
					return View::make('armyupdates',[ 'army_updates_pag'  => $army_updates_pag ]);
				}
) );

Route::post('/updates', array(
    'as' => 'army.updates.search',
    'uses' => 'ArmyUpdatesController@search'
) );

Route::get('/contributors', array(
    'as' => 'contributors',
    'uses' => function()
				{
					// $army_updates_list = ArmyUpdates::orderBy('s-no','asc')->get();
					$cu_list = User::where('contributor',true)->get();
					return View::make('contributors',[ 'contributor_users_list' => $cu_list ]);
				}
));

Route::get('/donate', array(
    'as' => 'donate',
    'uses' => function()
				{
					$dc_list = DonationCause::all();
					return View::make('donate',[ 'donation_causes_list' => $dc_list ]);
				}
));

Route::get('/DonationCauseAdd', array(
    'as' => 'donationcause.addform',
    'uses' => function()
				{
					return View::make('donationcause');
				}
));

Route::post('/DonationCauseAdd', array(
    'as' => 'donationcause.add',
    'uses' => 'DonationCauseController@create')
);

Route::get('siteimpact', array(
	'as'   => 'siteimpact',
	'uses' => function()
				{
					return View::make('siteimpact');
				}
));

// ===============================================================
//			User Authentication
// ===============================================================

// route to show the login form
Route::get('login', array(
	'as'   => 'login',
	'uses' => 'SessionController@showLogin'
) );

// route to process the form
Route::post('login', array('uses' => 'SessionController@doLogin'));

Route::get('logout', array(
	'as'   => 'logout',
	'uses' => 'SessionController@doLogout'
) );

// ===============================================================
//			Authenticated User -> dashboard
// ===============================================================


Route::get('dashboardold', array(
	    'as' => 'dashboard.old',
	    'uses' => function()
					{
						$msg_list = NULL;
						$fip_list = NULL;
						$au_count = NULL;
						$fop_list = NULL;
						$dc_list = NULL;
						if ( Auth::user()->messages()->count() > 0 ) {
							$msg_list = Auth::user()->messages()->orderBy('created_at','dsc')->get();
						}
						if ( Auth::user()->looker ) {
							$fip_list = Auth::user()->findPeople()->orderBy('created_at','dsc')->get();
						}
						if ( Auth::user()->contributor ) {
							$au_count = Auth::user()->numContributed();
						}
						if ( Auth::user()->finder ) {
							$fop_list = Auth::user()->foundPeople()->orderBy('created_at','dsc')->get();
						}
						if ( Auth::user()->donationcause_adder ) {
							$dc_list = Auth::user()->donationCausesAdded()->orderBy('created_at','dsc')->get();
						}
						
						return View::make('trying\dashboard',[ 'messages_list' => $msg_list,
															'find_people_list' => $fip_list,
															'army_updates_count' => $au_count,
															'found_people_list' => $fop_list,
															'donation_causes_list' => $dc_list
														  ]);
					}
	)
)->before('auth');

Route::get('dashboard', array(
	    'as' => 'dashboard',
	    'uses' => function()
					{
						$msg_list = NULL;
						$fip_list = NULL;
						$au_count = NULL;
						$fop_list = NULL;
						$dc_list = NULL;
						if ( Auth::user()->messages()->count() > 0 ) {
							$msg_list = Auth::user()->messages()->orderBy('created_at','dsc')->get();
						}
						if ( Auth::user()->looker ) {
							$fip_list = Auth::user()->findPeople()->orderBy('created_at','dsc')->get();
						}
						if ( Auth::user()->contributor ) {
							$au_count = Auth::user()->numContributed();
						}
						if ( Auth::user()->finder ) {
							$fop_list = Auth::user()->foundPeople()->orderBy('created_at','dsc')->get();
						}
						if ( Auth::user()->donationcause_adder ) {
							$dc_list = Auth::user()->donationCausesAdded()->orderBy('created_at','dsc')->get();
						}
						
						return View::make('paneldashboard',[ 'messages_list' => $msg_list,
														'find_people_list' => $fip_list,
														'army_updates_count' => $au_count,
														'found_people_list' => $fop_list,
														'donation_causes_list' => $dc_list
													  ]);
					}
	)
)->before('auth');

Route::post('claim', array(
	    'as' => 'claim',
	    'uses' => 'ClaimController@claim'
))->before('auth');

Route::post('duplicateclaim', array(
	    'as' => 'duplicate.claim',
	    'uses' => 'ClaimController@duplicateClaim'
))->before('auth');

// ===============================================================
//			Playing w code
// ===============================================================

// Route::get('/nav', function()
// {
// 	return View::make('navhome');
// });

Route::get('/tabs', function()
{
	return View::make('tabbedhome');
});

// ===============================================================
//			Debugging Helpers
// ===============================================================

Route::get('laravel', function()
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

Route::get('/findpeople', function()
{
	return Schema::hasTable('find-people');
});

Route::get('/foundpeople', function()
{
	return Schema::hasTable('find-people');
});

Route::get('/armyupdates', function()
{
	return Schema::hasTable('ARMY-Updates');
});

Route::get('/dbtest', function()
{
	//TODO: create table then test then del
	//$result = DB::table('created-table')->get();
	return "need to write";
});
