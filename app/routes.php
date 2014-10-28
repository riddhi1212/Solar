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

Route::get('/donate/supplies', array(
    'as' => 'donate.supplies',
    'uses' => function()
				{
					return View::make('donate_supplies');
				}
) );

Route::get('/donated/supplies/add', array(
    'as' => 'donated.supplies.add',
    'uses' => function()
				{
					return View::make('donated/supplies/add');
				}
) );

Route::post('/donated/supplies/add', array(
    'as' => 'donated.supplies.add',
    'uses' => 'RegisterDonatedSupplyController@create'
) );

Route::get('/about', array(
    'as' => 'about',
    'uses' => function()
				{
					return View::make('about');
				}
) );

Route::get('contact', array(
    'as' => 'contact.me',
    'uses' => function()
				{
					return View::make('contact');
				}
) );

Route::post('contact', array(
    'as' => 'contact.me',
    'uses' => 'UsersController@contactMe'
) );

Route::get('find/report', array(
    'as' => 'missing.person.report',
    'uses' => function()
				{
					$find_people_list = FindPeople::orderBy('created_at','dsc')->get();
					return View::make('find_person/list',[ 'find_people_list' => $find_people_list ]);
				}
) );

Route::get('found/report', array(
    'as' => 'found.person.report',
    'uses' => function()
				{
					$found_people_list = FoundPeople::orderBy('created_at','dsc')->get();
					return View::make('found_person/list',[ 'found_people_list' => $found_people_list ]);
				}
) );

Route::post('/find', array(
    'as' => 'find.people.create',
    'uses' => 'FindPeopleController@create'
) );

Route::post('deletefip', array(
    'as' => 'find.person.delete',
    'uses' => 'FindPeopleController@delete'
))->before('auth');

Route::get('findperson/edit/{id}', array(
    'as' => 'find.person.edit',
    'uses' => function($id)
				{
					$fip = FindPeople::find($id);
					return View::make('find_person/edit', [ 'fip' => $fip ]);
				}
))->before('auth');

Route::post('findperson/edit/{id}', array(
    'as' => 'find.person.edit',
    'uses' => 'FindPeopleController@edit'
))->before('auth');

Route::get('findperson/show/{id}', array(
    'as' => 'find.person.show',
    'uses' => function($id)
				{
					$fip = FindPeople::find($id);
					$looker = $fip->getLooker();
					return View::make('find_person/show', [ 'fip' => $fip,
															'looker' => $looker ]);
				}
));

Route::post('/found', array(
    'as' => 'found.people.create',
    'uses' => 'FoundPeopleController@create'
) );

Route::get('foundperson/show/{id}', array(
    'as' => 'found.person.show',
    'uses' => function($id)
				{
					$fop = FoundPeople::find($id);
					$finder = $fop->getFinder();
					return View::make('found_person/show', [ 'fop' => $fop,
															 'finder' => $finder ]);
				}
));

Route::get('foundperson/edit/{id}', array(
    'as' => 'found.person.edit',
    'uses' => function($id)
				{
					$fop = FoundPeople::find($id);
					return View::make('found_person/edit', [ 'fop' => $fop ]);
				}
))->before('auth');

Route::post('foundperson/edit/{id}', array(
    'as' => 'found.person.edit',
    'uses' => 'FoundPeopleController@edit'
))->before('auth');

Route::post('deletefop', array(
    'as' => 'found.people.delete',
    'uses' => 'FoundPeopleController@delete'
))->before('auth');


Route::get('AUdata', array(
    'as' => 'au.data',
    'uses' => function()
				{
					return Response::json(ArmyUpdates::all(array('first_name','age')));
				}
) );

Route::get('/updates', array(
    'as' => 'updates',
    'uses' => function()
				{
					$army_updates_pag = ArmyUpdates::orderBy('s_no','asc')->paginate(ArmyUpdates::SHOW_PER_PAGE);
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
					$cu_list = User::where('contributor',true)->get()->sortByDesc('contributed');
					return View::make('contributors',[ 'contributor_users_list' => $cu_list ]);
				}
));

Route::get('/contributor/add/form', array(
    'as' => 'contributor.add.form',
    'uses' => function()
				{
					return View::make('contributor/add');
				}
));

Route::post('/contributor/add', array(
    'as' => 'contributor.add',
    'uses' => 'ArmyUpdatesController@addContributor'
));

Route::get('/donate', array(
    'as' => 'donate',
    'uses' => function()
				{
					$dc_list = DonationCause::all();
					return View::make('donate/list',[ 'donation_causes_list' => $dc_list ]);
				}
));

Route::get('donation/show/{id}', array(
    'as' => 'donation.channel.show',
    'uses' => function($id)
				{
					$dc = DonationCause::find($id);
					return View::make('donate/show', [ 'donation_cause' => $dc ]);
				}
));

Route::get('/donation/channel/add/form', array(
    'as' => 'donation.channel.add.form',
    'uses' => function()
				{
					return View::make('donate/add');
				}
));

Route::post('/donation/channel/add', array(
    'as' => 'donation.channel.add',
    'uses' => 'DonationCauseController@create')
);

Route::get('donation/edit/{id}', array(
    'as' => 'donation.channel.edit',
    'uses' => function($id)
				{
					$dc = DonationCause::find($id);
					return View::make('donate/edit', [ 'dc' => $dc ]);
				}
))->before('auth');

Route::post('donation/edit/{id}', array(
    'as' => 'donation.channel.edit',
    'uses' => 'DonationCauseController@edit'
))->before('auth');

Route::get('donation/delete/{id}', array(
    'as' => 'donation.channel.delete',
    'uses' => 'DonationCauseController@delete'
))->before('auth');

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
						$uploads_count = Auth::user()->upload_number;
						$total_uploads = NULL;
						if ( Auth::user()->isAdmin() ){
							$total_uploads = DB::table(User::TABLE_NAME)->sum('upload_number');
						}
						
						return View::make('paneldashboard',[ 'messages_list' => $msg_list,
														'find_people_list' => $fip_list,
														'army_updates_count' => $au_count,
														'uploads_count' => $uploads_count,
														'total_uploads' => $total_uploads,
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
