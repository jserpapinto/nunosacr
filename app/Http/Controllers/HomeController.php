<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Vinkla\Instagram\Instagram;

// Models
use App\Artist;
use App\Work;
use App\Exhibition;
use App\WorksToExhibition;
use App\MailLog;
use DB;
use Config;


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
        // Featured Exhibition
        $exhibitionFeatured = DB::select('CALL exhibition_featured()')[0];
        if ($exhibitionFeatured) {
            $exhibitionFeaturedWorks = DB::select('CALL exhibition_works_featured()'); 
        }

        // Featured Works No Opportunity
        $worksOpportunity = DB::select('CALL works_opportunity('.Config::get('const.OPPORTUNITIES').', '.Config::get('const.HOME').')'); 

        // Featured Works Opportunity
        $worksNoOpportunity = DB::select('CALL works_opportunity('.Config::get('const.NO_OPPORTUNITIES').', '.Config::get('const.HOME').')'); 

        return view('frontend.index', compact('exhibitionFeatured', 'exhibitionFeaturedWorks', 'worksOpportunity', 'worksNoOpportunity'));
    }

    // Show contacts Page
    public function contacts()
    {
        return view('frontend.static.contacts');
    }

    // Send mail from contacts form
    public function contactsMail(Request $req)
    {
        $rules = [
            'name' => 'required|min:3|max:50',
            'mail' => 'required|email',
            'subject' => 'required|min:3|max:50',
            'message' => 'required|min:10',
        ];
        $this->validate($req, $rules);

        // MailLog 
        $mailLog = new MailLog();
        $mailLog->name = $req->name;
        $mailLog->email = $req->mail;
        $mailLog->subject = $req->subject;
        $mailLog->message = $req->message;
        $mailLog->form = "contacts";
        $mailLog->slug = uniqid();
        // Save in DB
        $mailLog->save();

        Mail::to('jserpa.dev@gmail.com')->send(new ContactMail($req->all()));

        return back()->with('success_status', 'Email Sent');
    }

    // Show contacts Page
    public function aboutus()
    {
        return view('frontend.static.aboutus');
    }

    public static function error404()
    {
        $featuredWorks = DB::select('CALL works_opportunity('.Config::get('const.NO_OPPORTUNITIES').', '.Config::get('const.HOME').')'); 
            return view('errors.404', compact('featuredWorks'));
    }
}
