<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Exhibition;

class ExhibitionController extends Controller
{
    //
    public function index()
    {
    	// Get all exhibitions
    	$allExhibitions = Exhibition::paginate('15');
    	return view('frontend.exhibitions.index', compact('allExhibitions'));
    }

    //
    public function solo($slug)
    {
    	// Get all exhibitions
    	$exhibition = Exhibition::whereSlug($slug)->first();
        $exhibitionArtists = $exhibition->artists()->get();
        $exhibitionWorks = $exhibition->works()
                                    ->select('works.*', 'artists.name as artist_name', 'artists.slug as artist_slug')
                                    ->join('artists', 'works.artist_id', '=', 'artists.id')
                                    ->get();
    	return view('frontend.exhibitions.solo', compact('exhibition', 'exhibitionWorks', 'exhibitionArtists'));
    }
}
