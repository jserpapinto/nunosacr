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

// Get Dashboard
Route::get("/admin/", 'AdminController@index');

/**
 *	ARTIST
 */
// Get list of Artists
Route::get("/admin/artistas", 'ArtistController@index');
// Get Form to update Artist
Route::get("/admin/artistas/{id}", 'ArtistController@editCreate');
// Update Artist
Route::put("/admin/artistas/{id}", 'ArtistController@update');
// Delete Artist
Route::delete("/admin/artistas/{id}", 'ArtistController@remove');
// Get Form to Create Artist
Route::get("/admin/artistas/criar", 'ArtistController@editCreate');
// Post new Artist
Route::post("/admin/artistas/criar", 'ArtistController@create');

/**
 *	WORK
 */
// Get List of Works
Route::get("/admin/obras", 'WorkController@index');
// Get Form to update Work
Route::get("/admin/obras/{id}", 'WorkController@editCreate');
// Update Work
Route::put("/admin/obras/{id}", 'WorkController@update');
// Delete Work
Route::delete("/admin/obras/{id}", 'WorkController@remove');
// Get Form to Create Work
Route::get("/admin/obras/criar", 'WorkController@editCreate');
// Post new Work
Route::post("/admin/obras/criar", 'WorkController@create');
