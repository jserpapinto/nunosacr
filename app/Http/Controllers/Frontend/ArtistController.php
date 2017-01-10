<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Artist;
use App\Work;
use App\Http\Controllers\HomeController;

class ArtistController extends Controller
{
    //
    public function index()
    {
		$allArtists = Artist::where('gallery', '=', 1)->orderBy('name', 'asc')->paginate('15');

		return view('frontend.artists.index', compact('allArtists'));
    }

    //
    public function solo($slug)
    {
    	$artist = Artist::whereSlug($slug)->first();
        if (!$artist || $artist->gallery == false) {
            return HomeController::error404();
        }

    	$works = $artist->works()->paginate('15');

		return view('frontend.artists.solo', compact('artist', 'works'));
    }
}
