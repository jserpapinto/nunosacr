<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Needed to use ArtistFormRequest
use App\Http\Requests\ArtistFormRequest;

use File;
use Image;
use Input;
// Model
use App\Artist;

class ArtistController extends Controller
{	

    private function uploadImgs ($req, $imgName) {
        // Path
        try {
            $path = public_path('upload/artists/profile/');
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
    public function editCreate($slug = null) {
        if ($slug) {
            $Artist = new Artist;
            $artist = $Artist->getOneBySlug($slug);
        } else $artist = null;

        return view('admin.artists.createEdit', compact('artist'));
    } 

    /**
     * Update One.
     */
    public function update($slug, ArtistFormRequest $req) {

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
        $artist = $artist->getOneBySlug($slug);
        $artist->name = $req->name;
        $artist->site = $req->site;
        $artist->email = $req->email;
        $artist->bio = $req->bio;
        if (isset($cvName)) $artist->cv = $cvName;
        if (isset($imgName)) $artist->img = $imgName;

        // Save in DB
        $artist->save();

        // Upload CV
        if ($req->hasFile('cv')) {
            $req->file('cv')->move(public_path() . '/upload/artists/cv/', $cvName);
        }

        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }

        return redirect()->action('Admin\ArtistController@index')->with('success_status', 'Artista Atualizado');
    }

    /**
     * Create New.
     */
    public function create(ArtistFormRequest $req) {

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
        $artist->slug = uniqid();
        if (isset($cvName)) $artist->cv = $cvName;
        if (isset($imgName)) $artist->img = $imgName;

        // Save in DB
        $artist->save();

        // Upload CV
        if ($req->hasFile('cv')) {
            $req->file('cv')->move(public_path('/upload/artists/cv/'), $cvName);
        }
        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }

        return redirect()->action('Admin\ArtistController@index')->with('success_status', 'Novo Artista Criado');
    }

    /**
     * Remove One.
     */
    public function remove($slug) {

        $artist = Artist::whereSlug($slug)->first();
        $artist->delete();
        return redirect()->action('Admin\ArtistController@index')->with('danger_status', 'Artista Removido');
    }

    public function listWorks($slug)
    {
        $artist = Artist::whereSlug($slug)->first();
        $works = $artist->works()->get();
        return view('admin.artists.listWorks', compact('artist', 'works'));
    }

}
