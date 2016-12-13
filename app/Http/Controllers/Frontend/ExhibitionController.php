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
    	$allExhibitions = Exhibition::all();
    	return view('frontend.exhibitions.index', compact('allExhibitions'));
    }

    //
    public function solo($slug)
    {
    	// Get all exhibitions
    	$exhibition = Exhibition::whereSlug($slug)->first();
        $exhibitionArtists = $exhibition->artists()->get();
        $exhibitionWorks = $exhibition->works()->get();
    	return view('frontend.exhibitions.solo', compact('exhibition', 'exhibitionWorks', 'exhibitionWorks'));
    }
}
