<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Artist;
use App\Work;
use App\Exhibition;
use Vinkla\Instagram\Instagram;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // Featured Artist
        $artistFeatured = Artist::where('featured', '=', '1')->get()->first();
        $artistFeaturedWorks = Work::where('artist_id', '=', $artistFeatured->id)
                                ->where('featured_to_artist', '=', 1)->get();


        // Featured Works No Opportunity
        $worksOpportunity = Work::where('opportunity', '=', 1)
                                    ->where('featured_to_home', '=', 1)
                                    ->join('artists', 'artist_id', '=', 'artists.id')
                                    ->select('works.*', 'artists.name as artist_name')
                                    ->get();

        // Featured Works Opportunity
        $worksNoOpportunity = Work::where('opportunity', '=', 0)
                                    ->where('featured_to_home', '=', 1)
                                    ->join('artists', 'artist_id', '=', 'artists.id')
                                    ->select('works.*', 'artists.name as artist_name')
                                    ->get();

        // Instagram posts

        return view('frontend.index', compact('artistFeatured', 'artistFeaturedWorks', 'worksOpportunity', 'worksNoOpportunity'));
    }
}
