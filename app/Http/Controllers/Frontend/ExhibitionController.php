<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Exhibition;
use App\Http\Controllers\HomeController;
use DB;

class ExhibitionController extends Controller
{
    //
    public function index()
    {
    	// Get all exhibitions
    	$allExhibitions = DB::select('CALL exhibitions_all()');
    	return view('frontend.exhibitions.index', compact('allExhibitions'));
    }

    //
    public function solo($slug)
    {
    	// Get all exhibitions
    	$exhibition = DB::select('CALL exhibition_by_slug("'.$slug.'")')[0]; 

        // 404
        if (!$exhibition) {
            return HomeController::error404();
        }

        $exhibitionWorks = DB::select('CALL works_from_exhibition('.$exhibition->id.')');

    	return view('frontend.exhibitions.solo', compact('exhibition', 'exhibitionWorks', 'exhibitionArtists'));
    }
}
