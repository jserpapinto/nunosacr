<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
 *
 *	Admin Area
 *
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {

	// Get Dashboard
	Route::get("/", 'AdminController@index');
	/**
	 *	ARTIST
	 */
	// Get list of Artists
	Route::get("/artistas", 'ArtistController@index');
	// Get Featured Artist
	Route::get("/artistas/destaque/{slug}", 'ArtistController@feature');
	// Get Form to update Artist
	Route::get("/artistas/{slug}/editar", 'ArtistController@editCreate');
	// Update Artist
	Route::put("/artistas/{slug}", 'ArtistController@update');
	// Delete Artist
	Route::delete("/artistas/{slug}", 'ArtistController@remove');
	// Get Form to Create Artist
	Route::get("/artistas/criar", 'ArtistController@editCreate');
	// Post new Artist
	Route::post("/artistas/criar", 'ArtistController@create');
	// Get all Works from Artist
	Route::get("/artistas/{slug}/obras", "ArtistController@listWorks");

	/**
	 *	WORK
	 */
	// Get List of All Works
	Route::get("/obras", 'WorkController@index');
	// Get List of Works
	Route::get("/obras/sem_oportunidades", 'WorkController@indexWithoutOpportunities');
	// Get List of Works
	Route::get("/obras/oportunidades", 'WorkController@indexOpportunities');
	// Get Form to update Work
	Route::get("/obras/{slug}/editar", 'WorkController@editCreate');
	// Feature Work to Artist
	Route::get("/obras/{slugWork}/artista/{idArtist}", 'WorkController@featureToArtist');
	// Update Work
	Route::put("/obras/{slug}", 'WorkController@update');
	// Delete Work
	Route::delete("/obras/{slug}", 'WorkController@remove');
	// Get Form to Create Work
	Route::get("/obras/criar", 'WorkController@editCreate');
	// Post new Work
	Route::post("/obras/criar", 'WorkController@create');
	// Feature Opportunity
	Route::get("/obras/{slug}/destaque_oportunidade", 'WorkController@featureOpportunity');
	// Feature NOT Opportunity
	Route::get("/obras/{slug}/destaque_oportunidade", 'WorkController@featureNotOpportunity');

	/**
	 *	PRESS
	 */
	// Get List of Press
	Route::get("/press", 'PressController@index');
	Route::get("/press/{slug}/editar", 'PressController@editCreate');
	Route::get("/press/criar", 'PressController@editCreate');
	Route::post("/press/criar", 'PressController@create');
	Route::put("/press/{slug}", 'PressController@update');
	Route::delete("/press/{slug}", 'PressController@remove');

	/**
	 *	EXHIBITION
	 */
	// Get List of Exhibitions
	Route::get("/exposicoes", 'ExhibitionController@index');
	Route::get("/exposicoes/{slug}/editar", 'ExhibitionController@editCreate');
	Route::get("/exposicoes/criar", 'ExhibitionController@editCreate');
	Route::get("/exposicoes/{slug}/obras", 'ExhibitionController@listWorks');
	Route::post("/exposicoes", 'ExhibitionController@create');
	Route::put("/exposicoes/{slug}", 'ExhibitionController@update');
	Route::delete("/exposicoes/{slug}", 'ExhibitionController@remove');
});


//Auth::routes();
// Authentication Routes...
Route::group(['prefix' => 'admin', 'namespace' => 'Auth'], function() {
	Route::get('/login', 'LoginController@showLoginForm');
	Route::post('/login', 'LoginController@login');
	Route::get('/logout', 'LoginController@logout');
	Route::post('/logout', 'LoginController@logout');

	// Password Reset Routes...
	Route::get('/password/reset/{token?}', 'ResetPasswordController@showResetForm');
	Route::post('/password/email', 'PasswordController@sendResetLinkEmail');
	Route::post('/password/reset', 'PasswordController@reset');


	// Registration Routes...
	// TODO: por dentro do admin route
	Route::get('/register', '\App\Http\Controllers\Auth\RegisterController@showRegistrationForm');
	Route::post('/register', '\App\Http\Controllers\Auth\RegisterController@register');
});


/*
 *
 *	Frontend Area
 *
 */
// Homepage
Route::get('/', 'HomeController@index');

// Static Pages
Route::get('/contacts', 'HomeController@contacts');
Route::post('/contacts/mail', 'HomeController@contactsMail');

Route::group(['namespace' => 'Frontend'], function () {
	// Artist Pages
	Route::get('/artists', 'ArtistController@index');
	Route::get('/artists/{slug}', 'ArtistController@solo');

	// Work Pages
	Route::get('/work/{slug}/solo', 'WorkController@solo');
	Route::get('/work/opportunities', 'WorkController@opportunities');

	// Press Pages
	Route::get('/press', 'PressController@index');


	// Mail
	Route::post('/work/{slug}/buyWork', 'WorkController@buyWorkEmail');
	
});
