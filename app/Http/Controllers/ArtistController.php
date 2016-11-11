<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Input;

// Model
use App\Artist;

class ArtistController extends Controller
{	
    /**
     * List all Artists.
     *
     * @return Response
     */
    public function index() {
        $Artist = new Artist;
        $allArtists = $Artist->getAll();

        return view('admin.artists.index', compact('allArtists'));
    }


    /**
     * View and Edit One.
     *
     * @return Response
     */
    public function edit($id) {
        $Artist = new Artist;
        $artist = $Artist->getOne($id);

        return view('admin.artists.createEdit', compact('artist'));
    } 

    /**
     * Update One.
     *
     * @return Response
     */
    public function update($id, Request $req) {
        if ($req->hasFile('cv')) echo "OIOIOI";
        else echo "BOIBOIOIB";
        var_dump($id);
        var_dump($req->file('cv'));
        //$req->file('cv')->move('/tmp/', 'ola.jpg');
    }

    /**Create New.
     *
     * @return Response
     */
    public function create() {

        return view('admin.artists.createEdit', compact('artist'));
    }

}
