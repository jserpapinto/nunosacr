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
	// Get Form to update Artist
	Route::get("/artistas/{slug}", 'ArtistController@editCreate');
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
	// Get List of Works
	Route::get("/obras", 'WorkController@index');
	// Get Form to update Work
	Route::get("/obras/{slug}", 'WorkController@editCreate');
	// Update Work
	Route::put("/obras/{slug}", 'WorkController@update');
	// Delete Work
	Route::delete("/obras/{slug}", 'WorkController@remove');
	// Get Form to Create Work
	Route::get("/obras/criar", 'WorkController@editCreate');
	// Post new Work
	Route::post("/obras/criar", 'WorkController@create');



	// Registration Routes...
	Route::get('/admin/register', 'Auth\registerController@showRegistrationForm');
	Route::post('/admin/register', 'Auth\registerController@register');

	// Password Reset Routes...
	Route::get('/admin/password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm');
	Route::post('/admin/password/email', 'Auth\PasswordController@sendResetLinkEmail');
	Route::post('/admin/password/reset', 'Auth\PasswordController@reset');

});

//Auth::routes();
// Authentication Routes...
Route::get('/admin/login', 'Auth\LoginController@showLoginForm');
Route::post('/admin/login', 'Auth\LoginController@login');
Route::get('/admin/logout', 'Auth\LoginController@logout');



Route::get('/home', 'HomeController@index');
