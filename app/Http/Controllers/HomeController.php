<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Artist;
use App\Work;
use App\Exhibition;

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
        $artists = Artist::all();
        $works = Work::where('opportunity', 1)->get();
        var_dump($works);
        return view('frontend.index');
    }
}
