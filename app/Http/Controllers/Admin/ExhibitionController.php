<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Needed to use ExhibitionFormRequest
use App\Http\Requests\ExhibitionFormRequest;

use File;
use Image;
use Input;

// Model
use App\Exhibition;
use App\Artist;
use App\Work;
use App\ArtistsToExhibition;
use App\WorksToExhibition;

class ExhibitionController extends Controller
{
    //
    private function uploadImgs ($req, $imgName) {
        // Path
        try {
            $path = public_path('upload/exhibitions/');
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
     * List all Exhibitions.
     */
    public function index() {
        $Exhibition = new Exhibition;
        $allExhibitions = $Exhibition->getAll();

        return view('admin.exhibitions.index', compact('allExhibitions'));
    }

    /**
     * View and Edit One.
     */
    public function editCreate($slug = null) {
    	$exhibition = null;
    	$exhibitionArtists = null;
        if ($slug) {
            $Exhibition = new Exhibition;
            $exhibition = $Exhibition->getOneBySlug($slug);
            $exhibitionArtists = $exhibition->artists->pluck('id')->toArray();
        	$exhibitionWorks = $exhibition->works->pluck('id')->toArray();
        }  

        // Get all Artists to multiselect
        $Artist = new Artist();
        $allArtists = $Artist->getAllNames();

        // Get all Works to multiselect
        $Work = new Work();
        $allWorks = $Work->getAllNames();

        return view('admin.exhibitions.createEdit', compact('exhibition', 'allArtists', 'allWorks', 'exhibitionArtists', 'exhibitionWorks'));
    }

	/**
     * Create New.
     */
    public function create(ExhibitionFormRequest $req) {


        // Generate Names for files
        // Mudar para string penso eu
        if ($req->hasFile('catalog')) {
            $catalogName = time() . '.pdf';
        }
        if ($req->hasFile('img')) {
            $ext = "." . $req->file('img')->getClientOriginalExtension();
            $imgName = time() . $ext;
        }

        // Get Exhibition to update
        $exhibition = new Exhibition();
        $exhibition->title = $req->title;
        $exhibition->description = $req->description;
        $exhibition->from = $req->from;
        $exhibition->to = $req->to;
        $exhibition->slug = uniqid();
        if (isset($catalogName)) $exhibition->catalog = $catalogName;
        if (isset($imgName)) $exhibition->img = $imgName;

        // Save in DB
        $exhibition->save();

        // Save to pivot table
        $exhibition->artists()->attach($req->artists);
        $exhibition->works()->attach($req->works);


        // Upload Catalog
        if ($req->hasFile('catalog')) {
            $req->file('catalog')->move(public_path('/upload/exhibitions/catalogs/'), $catalogName);
        }
        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }

        return redirect()->action('Admin\ExhibitionController@index')->with('success_status', 'Novo Press Criado');
    }

    /**
     * Update One.
     */
    public function update($slug, ExhibitionFormRequest $req) {


        // Generate Names for files
        // Mudar para string penso eu
        if ($req->hasFile('catalog')) {
            $catalogName = time() . '.pdf';
        }
        if ($req->hasFile('img')) {
            $ext = "." . $req->file('img')->getClientOriginalExtension();
            $imgName = time() . $ext;
        }

        // Get Exhibition to update
        $exhibition = new Exhibition();
        $exhibition = $exhibition->getOneBySlug($slug);
        $exhibition->title = $req->title;
        $exhibition->description = $req->description;
        if (!empty($req->from)) $exhibition->from = $req->from;
        if (!empty($req->to)) $exhibition->to = $req->to;
        if (isset($catalogName)) $exhibition->catalog = $catalogName;
        if (isset($imgName)) $exhibition->img = $imgName;

        // Save in DB
        $exhibition->save();

        // Remove all from pivot table
        $exhibition->artists()->detach($exhibition->artists);
        // Save to pivot table
        $exhibition->artists()->attach($req->artists);
        // Remove all from pivot table
        $exhibition->works()->detach($exhibition->works);
        // Save to pivot table
        $exhibition->works()->attach($req->works);


        // Upload Catalog
        if ($req->hasFile('catalog')) {
            $req->file('catalog')->move(public_path('/upload/exhibitions/catalogs/'), $catalogName);
        }
        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }

        return redirect()->action('Admin\ExhibitionController@index')->with('success_status', 'Novo Press Criado');
    }

    public function listWorks($slug)
    {   
        // Get ID from exhibition
        $exhibition = Exhibition::whereSlug($slug)->first();

        // Join with works and artists table
        $allArtists = ArtistsToExhibition::where('exhibition_id', '=', $exhibition->id)->join('artists', 'artist_to_exhibition.artist_id', '=', 'artist_id')->get();
        $allWorks = WorksToExhibition::where('exhibition_id', '=', $exhibition->id)->join('works', 'works_to_exhibition.work_id', '=', 'work_id')->get();


        return view('admin.exhibitions.listWorks', compact('exhibition', 'allArtists', 'allWorks'));

    }
}
