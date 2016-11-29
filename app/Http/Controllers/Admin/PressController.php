<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Needed to use PressFormRequest
use App\Http\Requests\PressFormRequest;

// Model
use App\Press;
use File;
use Image;
use Input;

class PressController extends Controller
{
    //
    private function uploadImgs ($req, $imgName) {
        // Path
        try {
            $path = public_path('upload/press/');
            // Instaciate class Image
            $image = Image::make(Input::file('img'));
            // Original
            /*$image_original = $image->fit(1000,1000, function($constraint) {
                $constraint->upsize();
            });*/
            $image->save($path . 'original/' . $imgName);
            // Mid sized
            $image_mid = $image->fit(500,250, function($constraint) {
                $constraint->upsize();
            });
            $image_mid->save($path . 'midsize/' . $imgName);
            // Thumbnail
            $image_thumb = $image->fit(100,50, function($constraint) {
                $constraint->upsize();
            });
            $image_thumb->save($path . 'thumb/' . $imgName);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * List all Presses.
     */
    public function index() {
        $Press = new Press;
        $allPress = $Press->getAll();

        return view('admin.press.index', compact('allPress'));
    }

    /**
     * View and Edit One.
     */
    public function editCreate($slug = null) {
        if ($slug) {
            $Press = new Press;
            $press = $Press->getOneBySlug($slug);
        } else $press = null;

        return view('admin.press.createEdit', compact('press'));
    }

    /**
     * Update One.
     */
    public function update($slug, PressFormRequest $req) {

        // Generate Names for files
        if ($req->hasFile('pdf')) {
            $pdfName = time() . '.pdf';
        }
        if ($req->hasFile('img')) {
            $ext = "." . $req->file('img')->getClientOriginalExtension();
            $imgName = time() . $ext;
        }

        // Get Press to update
        $press = new Press();
        $press = $press->getOneBySlug($slug);
        $press->name = $req->name;
        $press->description = $req->description;
        if (isset($pdfName)) $press->pdf = $pdfName;
        if (isset($imgName)) $press->img = $imgName;

        // Save in DB
        $press->save();

        // Upload CV
        if ($req->hasFile('pdf')) {
            $req->file('pdf')->move(public_path('/upload/press/pdfs/'), $pdfName);
        }
        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }

        return redirect()->action('Admin\PressController@index')->with('success_status', 'Press Atualizado');
    }

    /**
     * Create New.
     */
    public function create(PressFormRequest $req) {


        // Generate Names for files
        if ($req->hasFile('pdf')) {
            $pdfName = time() . '.pdf';
        }
        if ($req->hasFile('img')) {
            $ext = "." . $req->file('img')->getClientOriginalExtension();
            $imgName = time() . $ext;
        }

        // Get Press to update
        $press = new Press();
        $press->name = $req->name;
        $press->description = $req->description;
        $press->slug = uniqid();
        if (isset($pdfName)) $press->pdf = $pdfName;
        if (isset($imgName)) $press->img = $imgName;

        // Save in DB
        $press->save();

        // Upload CV
        if ($req->hasFile('pdf')) {
            $req->file('pdf')->move(public_path('/upload/press/pdfs/'), $pdfName);
        }
        // Upload img
        if ($req->hasFile('img')) {
            $this->uploadImgs($req, $imgName);
        }

        return redirect()->action('Admin\PressController@index')->with('success_status', 'Novo Press Criado');
    }

    /**
     * Remove One.
     */
    public function remove($slug) {

        $press = Press::whereSlug($slug)->first();
        $press->delete();
        return redirect()->action('Admin\PressController@index')->with('danger_status', 'Press Removido');
    }
}
