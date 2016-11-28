<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Artist;

class ArtistController extends Controller
{
    //
    public function index()
    {
		$allArtists = Artist::where('gallery', '=', 1)->get();

		return view('frontend.artists.index', compact('allArtists'));
    }

    //
    public function solo($slug)
    {
    	$artist = Artist::whereSlug($slug)->first();
    	$works = $artist->works()->get();

		return view('frontend.artists.solo', compact('artist', 'works'));
    }
}
