<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Needed to use ExhibitionFormRequest
use App\Http\Requests\ExhibitionFormRequest;

use File;
use Image;
use Input;
use DB;

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

    private function uploadImgBanner ($req, $imgName) {
        // Path
        try {
            $path = public_path('upload/exhibitions/banner/');
            // Instaciate class Image
            $image = Image::make(Input::file('imgBanner'));
            // Original
            $image_original = $image;
            $image_original->save($path . $imgName);
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
        $allExhibitions = $Exhibition->paginate('15');

        return view('admin.exhibitions.index', compact('allExhibitions'));
    }

    /**
     * View and Edit One.
     */
    public function editCreate($slug = null) {
    	$exhibition = null;
        if ($slug) {
            $Exhibition = new Exhibition;
            $exhibition = $Exhibition->getOneBySlug($slug); // StoreProcedure in Model
        	$exhibitionWorks = DB::select('CALL works_from_exhibition('.$exhibition->id.')');
        }  

        // Get all Works to multiselect
        $Work = new Work();

        return view('admin.exhibitions.createEdit', compact('exhibition', 'allArtists', 'exhibitionWorks'));
    }

	/**
     * Create New.
     */
    public function create(ExhibitionFormRequest $req) {


        // Generate Names for files
        // Mudar para string penso eu
        if ($req->hasFile('img')) {
            $ext = "." . $req->file('img')->getClientOriginalExtension();
            $imgName = time() . $ext;
        }
        if ($req->hasFile('imgBanner')) {
            $ext = "." . $req->file('imgBanner')->getClientOriginalExtension();
            $imgBannerName = time() . $ext;
        }

        // Get Exhibition to update
        $exhibition = new Exhibition();
        $exhibition->title = $req->title;
        $exhibition->from = $req->from;
        $exhibition->to = $req->to;
        $exhibition->description = $req->description;
        //$exhibition->slug = uniqid();
        if (isset($imgName)) $exhibition->img = $imgName;
        if (isset($imgBannerName)) $exhibition->imgBanner = $imgBannerName;

        // Save in DB
        $exhibition->save();

        // Save to pivot table
        $exhibition->works()->attach($req->selected_works);


        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }
        // Upload imgBanner
        if ($req->hasFile('imgBanner')) {
            $this->uploadImgBanner($req, $imgBannerName);
        }

        return redirect()->action('Admin\ExhibitionController@index')->with('success_status', 'Nov Exposição Criada');
    }

    /**
     * Update One.
     */
    public function update($slug, ExhibitionFormRequest $req) {

        // Generate Names for files
        // Mudar para string penso eu
        if ($req->hasFile('img')) {
            $ext = "." . $req->file('img')->getClientOriginalExtension();
            $imgName = time() . $ext;
        }
        if ($req->hasFile('imgBanner')) {
            $ext = "." . $req->file('imgBanner')->getClientOriginalExtension();
            $imgBannerName = time() . $ext;
        }

        // Get Exhibition to update
        $exhibition = new Exhibition();
        $exhibition = $exhibition->getOneBySlug($slug);
        $exhibition->title = $req->title;
        $exhibition->description = $req->description;
        if (!empty($req->from)) $exhibition->from = $req->from;
        if (!empty($req->to)) $exhibition->to = $req->to;
        if (isset($imgName)) $exhibition->img = $imgName;
        if (isset($imgBannerName)) $exhibition->imgBanner = $imgBannerName;

        // Save in DB
        $exhibition->save();

        // Remove all from pivot table
        $exhibition->works()->detach($exhibition->selected_works);
        // Save to pivot table
        $exhibition->works()->attach($req->selected_works);


        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }
        // Upload imgBanner
        if ($req->hasFile('imgBanner')) {
            $this->uploadImgBanner($req, $imgBannerName);
        }

        return redirect()->back()->with('success_status', 'Exposição Atualizada.')->with('warning_status', ' Se a exposição estiver destacada na HomePage, por favor destaque novamente as 3 obras que acompanham a exposição na HomePage.');
    }

    public function listWorks($slug)
    {   
        // Get ID from exhibition
        $exhibition = Exhibition::whereSlug($slug)->first();

        // Join with works table
        $allWorks = WorksToExhibition::where('exhibition_id', '=', $exhibition->id)
                                ->join('works', 'works_to_exhibition.work_id', '=', 'works.id')
                                ->where('works.deleted_at', '=', NULL)
                                ->get();
        return view('admin.exhibitions.listWorks', compact('exhibition', 'allArtists', 'allWorks'));

    }

    public function remove($slug)
    {   

        $exhibition = Exhibition::whereSlug($slug)->first();
        $exhibition->delete();
        return back()->with('danger_status', 'Exposição Removida');
    }

    public function feature($slug)
    {
        // Feature Exhibition to home page
        $allExhibitions = Exhibition::where('featured', '=', 1)->update(['featured' => 0]);
        $exhibition = Exhibition::whereSlug($slug);
        $exhibition->update(['featured' => 1]);

        return redirect()->back()->with('success_status', 'Exposição destacada na homepage.');
    }

    public function featureWork($slugExhibition, $slugWork)
    {
        // Feature Work Exhibition to home page

        // Get exhibition and work to feature
        $exhibition = Exhibition::whereSlug($slugExhibition)->first();
        $work = Work::whereSlug($slugWork)->first();
        $featureWork = WorksToExhibition::where([
                            ['work_id', '=', $work->id],
                            ['exhibition_id', '=', $exhibition->id]
                        ])->first();
        // Take out feature
        if ($featureWork->featured_to_exhibition == 1) {
            $featureWork->update(['featured_to_exhibition' => 0]);
            return redirect()->back()->with('success_status', 'Retirado destaque.');
        }

        // Check if there is space for another feature (max:3)
        $countFeaturedWorks = WorksToExhibition::where([
                                ['exhibition_id', '=', $exhibition->id],
                                ['featured_to_exhibition', '=', 1]
                            ])->count();

        // Return if max exceeded
        if ($countFeaturedWorks >= 3) {
            return redirect()->back()->with('danger_status', 'Máximo de 3 trabalhos destacados.');
        }

        // Feature it
        $featureWork->update(['featured_to_exhibition' => 1]);

        return redirect()->back()->with('success_status', 'Trabalho destacado na homepage.');
    }


    // Match artists by name
    public function matchArtist(Request $req)
    {
        $artists = Artist::where('name', 'LIKE', "%$req->search%")->paginate('15');

        return $artists;
    }
    // Match artists by name
    public function getWorksFromArtist(Request $req)
    {
        $works = Work::where('artist_id', '=', "$req->id")->get();

        return $works;
    }
}
