<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Artist;
use App\Work;
use App\Http\Controllers\HomeController;
use DB;

class ArtistController extends Controller
{
    //
    public function index()
    {   
		$allArtists = DB::select('CALL artists_from_gallery()');

		return view('frontend.artists.index', compact('allArtists'));
    }

    //
    public function solo($slug)
    {
    	$artist = DB::select('CALL artist_by_slug("'.$slug.'")')[0]; //Artist::whereSlug($slug)->first();
        if (!$artist || $artist->gallery == false) {
            return HomeController::error404();
        }

    	$works = DB::select('CALL artist_works('.$artist->id.')'); // $artist->works();

		return view('frontend.artists.solo', compact('artist', 'works'));
    }
}
