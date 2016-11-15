<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Input;

// Models
use App\Work;
use App\Artist;

class WorkController extends Controller
{	
	// Define rules
    private function rules() {
        $rules = [
            "name" => "required",
            "description" => "nullable",
            "price" => "nullable",
            "desconto" => "nullable",
            "artista" => "integer",
            "img" => "image|nullable",
            "opportunity" => "boolean"
        ];
        return $rules;
    }

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

    public function editCreate($id = null)
    {	
    	// Get work if passed ID
        if ($id) {
            $Work = new Work();
            $work = $Work->getOne($id);
        } else $work = null;

        // Get List of Artist to associate with
        $Artist = new Artist();
        $allArtists = $Artist->getAllNames();

        return view('admin.works.createEdit', compact('work', 'allArtists'));
    }

    public function update($id, Request $req)
    {
    	 // Validate
        $this->validate($req, $this->rules());

        // Generate Names for files
        if ($req->hasFile('img')) {
            $ext = "." . $req->file('img')->getClientOriginalExtension();
            $imgName = time() . $ext;
        }

        // Get Artist to update
        $work = new Work();
        $work = $work->getOne($id);
        $work->name = $req->name;
        $work->price = $req->price;
        $work->discount = $req->discount;
        $work->description = $req->description;
        $work->opportunity = $req->opportunity;
        $work->artist_id = $req->artist;
        if (isset($imgName)) $work->img = $imgName;

        $work->save();

        $id = $work->id;

        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }

        return redirect()->action('WorkController@index', ['updated' => true]);
    }

    public function create(Request $req)
    {
    	 // Validate
        $this->validate($req, $this->rules());

        // Generate Names for files
        if ($req->hasFile('img')) {
            $ext = "." . $req->file('img')->getClientOriginalExtension();
            $imgName = time() . $ext;
        }

        // Get Artist to update
        $work = new Work();
        $work->name = $req->name;
        $work->price = $req->price;
        $work->discount = $req->discount;
        $work->description = $req->description;
        $work->opportunity = $req->opportunity;
        $work->artist_id = $req->artist;
        if (isset($imgName)) $work->img = $imgName;

        $work->save();

        $id = $work->id;

        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }

        return redirect()->action('WorkController@index', ['created' => true]);
    }

    public function remove($id)
    {   

        $work = Work::find($id);
        $work->delete();
        return redirect()->action('WorkController@index', ['deleted' => true]);
    }
}
