<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Artist;

class ArtistController extends Controller
{	
    /**
     * Admin Index PAge.
     *
     * @return Response
     */
    public function index() {
    	return view('admin.index');
    }

    /**
     * List all Artists.
     *
     * @return Response
     */
    public function listAll() {
    	$Artist = new Artist;
    	$allArtists = $Artist->getAll();

    	return view('admin.artists', compact('allArtists'));
    }

}
