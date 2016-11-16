<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Request WorkFormRequests
use App\Http\Requests\WorkFormRequest;
use Image;
use Input;

// Models
use App\Work;
use App\Artist;

class WorkController extends Controller
{	

    private function uploadImgs ($req, $imgName) {
        // Path
        try {
            $path = public_path('upload/works/');
            // Instaciate class Image
            $image = Image::make(Input::file('img'));
            // Original
            $image_original = $image->fit(1000,1000, function($constraint) {
                $constraint->upsize();
            });
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
    	$allWorks = $Work->getAll();

    	/*echo "<pre>";
    	var_dump($allWorks);
    	echo "</pre>";
    	return false;*/

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
        if($req->discount != null && !empty($req->discount)) $work->discount = $req->discount;
        $work->description = $req->description;
        $work->opportunity = $req->opportunity;
        $work->artist_id = $req->artist;
        if (isset($imgName)) $work->img = $imgName;

        // Save in DB
        $work->save();

        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }

        return redirect()->action('Admin\WorkController@index')->with('success_status', 'Obra Atualizada');
    }

    public function create(WorkFormRequest $req)
    {

        // Generate Names for files
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
        $work->slug = uniqid();
        if (isset($imgName)) $work->img = $imgName;

        // Save in DB
        $work->save();

        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }

        return redirect()->action('Admin\WorkController@index')->with('success_status', 'Nova Obra Criada');
    }

    public function remove($slug)
    {   

        $work = Work::whereSlug($slug)->first();
        $work->delete();
        return redirect()->action('Admin\WorkController@index')->with('danger_status', 'Obra Removida');
    }
}
