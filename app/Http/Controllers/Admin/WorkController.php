<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Request WorkFormRequests
use App\Http\Requests\WorkFormRequest;
use Image;
use Input;
use Auth;

// Models
use App\Work;
use App\Artist;
use App\WorksToExhibition;

class WorkController extends Controller
{	
    const WITHOUT_OPPORTUNITIES = 1;
    const OPPORTUNITIES = 2;

    private function uploadImgs ($req, $imgName) {
        // Path
        try {
            $path = public_path('upload/works/');
            // Instaciate class Image
            $image = Image::make(Input::file('img'));
            // Original
            $image_original = $image;
            $image_original->save($path . 'original/' . $imgName);
            // Mid sized
            $image_mid = $image->fit(500,500, function($constraint) {
                $constraint->upsize();
            });
            $image_mid->save($path . 'midsize/' . $imgName);
            // Thumbnail
            $image_thumb = $image->fit(100,100, function($constraint) {
                $constraint->upsize();
            });
            $image_thumb->save($path . 'thumb/' . $imgName);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    //
    public function index()
    {
        $Work = new Work(); 
        $allWorks = $Work->paginate('15');

    	return view('admin.works.index', compact('allWorks'));
    }

    public function indexWithoutOpportunities()
    {
        $Work = new Work(); 
        $allWorks = $Work->getAllNoOpportunities();
        return view('admin.works.index', compact('allWorks'));
    }


    public function indexOpportunities()
    {
        $Work = new Work(); 
        $allWorks = $Work->getAllOpportunities();
        return view('admin.works.index', compact('allWorks'));
    }

    public function editCreate($slug = null)
    {	
    	// Get work if passed ID
        if ($slug) {
            $Work = new Work();
            $work = $Work->getOneBySlug($slug);
        } else $work = null;

        // Get List of Artist to associate with
        $Artist = new Artist();
        $allArtists = $Artist->getAllNames();

        return view('admin.works.createEdit', compact('work', 'allArtists'));
    }

    public function update($slug, WorkFormRequest $req)
    {

        // Generate Names for files
        if ($req->hasFile('img')) {
            $ext = "." . $req->file('img')->getClientOriginalExtension();
            $imgName = time() . $ext;
        }

        // Get Artist to update
        $work = new Work();
        $work = $work->getOneBySlug($slug);
        $work->name = $req->name;
        if($req->price != null && !empty($req->price)) $work->price = $req->price;
        if($req->discount != null && !empty($req->discount)) {
            $work->discount = $req->discount;
        } else {
            $work->discount = 0;
        }
        $work->description = $req->description;
        $work->opportunity = $req->opportunity;
        $work->artist_id = $req->artist;
        $work->sold = $req->sold;
        if (isset($imgName)) $work->img = $imgName;

        // Save in DB
        $work->save();

        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }

        return back()->with('success_status', 'Obra Atualizada');
    }

    public function create(WorkFormRequest $req)
    {

        // Generate Names for file
        if ($req->hasFile('img')) {
            $ext = "." . $req->file('img')->getClientOriginalExtension();
            $imgName = time() . $ext;
        }

        // Get Artist to update
        $work = new Work();
        $work->name = $req->name;
        if($req->price != null && !empty($req->price)) $work->price = $req->price;
        if($req->discount != null && !empty($req->discount)) $work->discount = $req->discount;
        $work->description = $req->description;
        $work->opportunity = $req->opportunity;
        $work->artist_id = $req->artist;
        $work->user_id = Auth::user()->id;
        $work->sold = $req->sold;
        //$work->slug = uniqid();
        if (isset($imgName)) $work->img = $imgName;

        // Save in DB
        $work->save();

        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }

        return back()->with('success_status', 'Nova Obra Criada');
    }

    public function remove($slug)
    {   

        $work = Work::whereSlug($slug)->first();
        $work->delete();
        return back()->with('danger_status', 'Obra Removida');
    }

    public function featureToArtist($slugWork, $idArtist)
    {   
        $work = Work::whereSlug($slugWork)->first();
        // Tira destaque se já estiver destacado
        if ($work->featured_to_artist) {
            $work->update(['featured_to_artist' => 0]);
            return back()->with('success_status', 'Obra retirada de destaque.');
        }

        // Conta os que estão em destaque, max = 3
        elseif (Work::where('artist_id', '=', $idArtist)->where('featured_to_artist', '=', 1)->count() == 3) {
            return back()->with('danger_status', 'Demasiadas obras destacadas, pf retire o destaque de uma primeiro.');
        }

        // Se count < 3, coloca em destaque 
        else {
            $work->update(['featured_to_artist' => 1]);
            return back()->with('success_status', 'Obra Destacada');
        }
    }

    public function featureOpportunity($slug)
    {   
        $work = Work::whereSlug($slug)->first();
        // Tira destaque se já estiver destacado
        if ($work->featured_to_home) {
            $work->update(['featured_to_home' => 0]);
            return back()->with('success_status', 'Obra retirada de destaque.');
        }

        // Conta os que estão em destaque, max = 6
        elseif (Work::where('featured_to_home', '=', 1)->where('opportunity', '=', '1')->count() == 6) {
            return back()->with('danger_status', 'Demasiadas obras de oportunidades destacadas, pf retire o destaque de uma primeiro.');
        }

        // Se count < 3, coloca em destaque 
        else {
            $work->update(['featured_to_home' => 1]);
            return back()->with('success_status', 'Obra Destacada');
        }
    }

    public function featureNotOpportunity($slug)
    {   
        $work = Work::whereSlug($slug)->first();
        // Tira destaque se já estiver destacado
        if ($work->featured_to_home) {
            $work->update(['featured_to_home' => 0]);
            return back()->with('success_status', 'Obra retirada de destaque.');
        }

        // Conta os que estão em destaque, max = 6
        elseif (Work::where('featured_to_home', '=', 1)->where('opportunity', '=', '0')->count() == 6) {
            return back()->with('danger_status', 'Demasiadas obras destacadas, pf retire o destaque de uma primeiro.');
        }

        // Se count < 3, coloca em destaque 
        else {
            $work->update(['featured_to_home' => 1]);
            return back()->with('success_status', 'Obra Destacada');
        }
    }

    public function search(Request $req)
    {   
        $allWorks = Work::where('name', 'LIKE', "%$req->search%")->paginate('15');

        return view('admin.works.index', compact('allWorks'));
    }
}
