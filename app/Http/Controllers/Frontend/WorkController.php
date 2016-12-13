<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\BuyWork;

// Model
use App\Work;
use App\MailLog;

class WorkController extends Controller
{
    //
    public function solo($slug)
    {
    	$work = Work::whereSlug($slug)->first();
    	$artist = $work->artist()->first();

        // Fetured Works from homepage
        if ($work->opportunity) {
            // Featured Works No Opportunity
            $featuredWorks = Work::where('opportunity', '=', 1)
                                    ->where('featured_to_home', '=', 1)
                                    ->join('artists', 'artist_id', '=', 'artists.id')
                                    ->select('works.*', 'artists.name as artist_name')
                                    ->inRandomOrder()
                                    ->limit(5)
                                    ->get();
        } else {
            // Featured Works Opportunity
            $featuredWorks = Work::where('opportunity', '=', 0)
                                    ->where('featured_to_home', '=', 1)
                                    ->join('artists', 'artist_id', '=', 'artists.id')
                                    ->select('works.*', 'artists.name as artist_name')
                                    ->inRandomOrder()
                                    ->limit(5)
                                    ->get();
        }

    	return view('frontend.works.solo', compact('work', 'artist', 'featuredWorks'));
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
            'name' => 'required|min:3|max:50',
            'mail' => 'required|email',
            'subject' => 'required|min:3|max:50',
            'message' => 'required|min:10'
        ];
        $this->validate($req, $rules);

        // MailLog 
        $mailLog = new MailLog();
        $mailLog->name = $req->name;
        $mailLog->email = $req->mail;
        $mailLog->subject = $req->subject;
        $mailLog->message = $req->message;
        $mailLog->form = "buyWork " . $slug;
        $mailLog->slug = uniqid();
        // Save in DB
        $mailLog->save();


        Mail::to('jserpa.dev@gmail.com')->send(new buyWork($req->all()));
        return "OK";
    }
}
