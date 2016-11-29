<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\BuyWork;

// Model
use App\Work;

class WorkController extends Controller
{
    //
    public function solo($slug)
    {
    	$work = Work::whereSlug($slug)->first();
    	$artist = $work->artist()->first();

    	return view('frontend.works.solo', compact('work', 'artist'));
    }

    public function opportunities()
    {	
    	$Work = new Work();
    	$allWorks = $Work->getAllOpportunities();
		return view('frontend.works.opportunities', compact('allWorks'));
    }

    public function buyWorkEmail(Request $req, $slug)
    {
        $rules = [
            'client_name' => 'required|min:3|max:50',
            'client_mail' => 'required|email',
            'client_subject' => 'required|min:3|max:50',
            'client_message' => 'required|min:10'
        ];
        $this->validate($req, $rules);
        Mail::to('jserpa.dev@gmail.com')->send(new buyWork($req->all()));
        return response('OK', 200);
    }
}
