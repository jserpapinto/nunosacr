<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\BuyWork;

// Model
use App\Work;
use App\MailLog;
use App\Http\Controllers\HomeController;
use DB;
use Config;
class WorkController extends Controller
{
    //
    public function solo($slug)
    {   
        // Get Work
    	$work = DB::select('CALL works_by_slug("'.$slug.'")')[0];
        // Get Artist from work
        $artist = DB::select('CALL work_artist('.$work->artist_id.')')[0]; 
        // 404
        if (!$work || !$artist) {
            return HomeController::error404();
        }

        // Fetured Works from homepage
        if ($work->opportunity) {
            // Featured Works No Opportunity
            $featuredWorks = DB::select('CALL works_opportunity('.Config::get('const.OPPORTUNITIES').','.Config::get('const.HOME').')');
        } else {
            // Featured Works Opportunity
            $featuredWorks = DB::select('CALL works_opportunity('.Config::get('const.NO_OPPORTUNITIES').','.Config::get('const.HOME').')');
        }

    	return view('frontend.works.solo', compact('work', 'artist', 'featuredWorks'));
    }

    public function opportunities()
    {	
        // Get All opportunities
        $allWorks = DB::select('CALL works_opportunity('.Config::get('const.NO_OPPORTUNITIES').','.Config::get('const.NO_HOME').')');
        
		return view('frontend.works.opportunities', compact('allWorks'));
    }

    public function buyWorkEmail(Request $req, $slug)
    {
        $rules = [
            'name' => 'required|min:3|max:50',
            'mail' => 'required|email',
            'subject' => 'required|min:3|max:50',
            'message' => 'required|min:10',
            'workName' => 'required'
        ];
        $this->validate($req, $rules);

        // MailLog 
        $mailLog = new MailLog();
        $mailLog->name = $req->name;
        $mailLog->email = $req->mail;
        $mailLog->subject = $req->subject;
        $mailLog->message = $req->message;
        $mailLog->form = "buyWork " . $req->workName;
        $mailLog->slug = uniqid();
        // Save in DB
        $mailLog->save();


        Mail::to('jserpa.dev@gmail.com')->send(new buyWork($req->all()));
        return "OK";
    }
}
