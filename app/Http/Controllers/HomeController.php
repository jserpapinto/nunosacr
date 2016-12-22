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
        $exhibitionFeatured = Exhibition::where('featured', '=', '1')->get()->first();
        if ($exhibitionFeatured) {
            $exhibitionFeaturedWorks = WorksToExhibition::where('exhibition_id', '=', $exhibitionFeatured->id)
                                    ->join('works', 'works_to_exhibition.work_id', '=', 'works.id')
                                    ->where([['works.deleted_at', '=', NULL], ['works_to_exhibition.featured_to_exhibition', '=', 1]])
                                    ->get();
        }


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
}
