<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Press;

class PressController extends Controller
{
    //
    public function index()
    {
    	$allPress = Press::all();
    	
    	return view('frontend.press.index', compact('allPress'));
    }
}
