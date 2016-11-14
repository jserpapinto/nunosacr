<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Image;
use Input;
// Model
use App\Artist;

class ArtistController extends Controller
{	

    private function rules() {
        // Define rules
        $rules = [
            "name" => "required",
            "site" => "nullable",
            "email" => "required|email",
            "bio" => "nullable",
            "cv" => "file|nullable",
            "img" => "image|nullable"
        ];
        return $rules;
    }

    /**
     * List all Artists.
     */
    public function index() {
        $Artist = new Artist;
        $allArtists = $Artist->getAll();

        return view('admin.artists.index', compact('allArtists'));
    }

    /**
     * View and Edit One.
     */
    public function editCreate($id = null) {
        if ($id) {
            $Artist = new Artist;
            $artist = $Artist->getOne($id);
        } else $artist = null;

        return view('admin.artists.createEdit', compact('artist'));
    } 

    /**
     * Update One.
     */
    public function update($id, Request $req) {
        // Validate
        $this->validate($req, $this->rules());

        // Generate Names for files
        if ($req->hasFile('cv')) {
            $cvName = time() . '.pdf';
        }
        if ($req->hasFile('img')) {
            $ext = "." . $req->file('img')->getClientOriginalExtension();
            $imgName = time() . $ext;
        }

        // Get Artist to update
        $artist = Artist::find($id);
        $artist->name = $req->name;
        $artist->site = $req->site;
        $artist->email = $req->email;
        $artist->bio = $req->bio;
        if (isset($cvName)) $artist->cv = $cvName;
        if (isset($imgName)) $artist->img = $imgName;

        $artist->save();

        // Upload CV
        if ($req->hasFile('cv')) {
            $req->file('cv')->move(public_path() . '/upload/artists/' . $id . '/cv/', $cvName);
        }

        // Upload img
        if ($req->hasFile('img')) {
            // Original
            $image = Image::make(Input::file('img'));
            // Mid sized
            $image_mid = $image->fit(500,500, function($constraint) {
                $constraint->upsize();
            });
            // Thumbnail
            $image_thumb = $image->fit(100,100, function($constraint) {
                $constraint->upsize();
            });
            // Path
            $path = public_path('upload/artists/' . $id . '/profile/');
            if (!File::exists($path)) {
                File::makeDirectory($path . 'original', 0775, true, true);
                File::makeDirectory($path . 'midsize', 0775, true, true);
                File::makeDirectory($path . 'thumb', 0775, true, true);
            }
            // Save images
            $image->save($path . 'original/' . $imgName);
            $image_mid->save($path . 'midsize/' . $imgName);
            $image_thumb->save($path . 'thumb/' . $imgName);
        }

        return redirect()->action('ArtistController@index', ['updated' => true]);
    }

    /**
     * Create New.
     */
    public function create(Request $req) {
        // Validate
        $this->validate($req, $this->rules());

        // Generate Names for files
        if ($req->hasFile('cv')) {
            $cvName = time() . '.pdf';
        }
        if ($req->hasFile('img')) {
            $ext = "." . $req->file('img')->getClientOriginalExtension();
            $imgName = time() . $ext;
        }

        // Get Artist to update
        $artist = new Artist();
        $artist->name = $req->name;
        $artist->site = $req->site;
        $artist->email = $req->email;
        $artist->bio = $req->bio;
        if (isset($cvName)) $artist->cv = $cvName;
        if (isset($imgName)) $artist->img = $imgName;

        $artist->save();

        $id = $artist->id;

        // Upload CV
        if ($req->hasFile('cv')) {
            $req->file('cv')->move(public_path('/upload/artists/' . $id . '/cv/'), $cvName);
        }

        // Upload img
        if ($req->hasFile('img')) {
            $req->file('img')->move(public_path('/upload/artists/' . $id . '/profile/'), $imgName);
        }

        return redirect()->action('ArtistController@index', ['created' => true]);
    }

    /**
     * Remove One.
     */
    public function remove($id) {

        $success = File::deleteDirectory(public_path('upload/artists/' . $id));

        if ($success) {
            $artist = Artist::find($id);
            $artist->delete();
            return redirect()->action('ArtistController@index', ['deleted' => true]);
        }

        return redirect()->action('ArtistController@index');
    }

}
