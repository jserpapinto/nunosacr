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
