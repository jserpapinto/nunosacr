<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
	// Use column deleted_at from database instead of fully deleting item
	use SoftDeletes;
	// protects against mass assign
	protected $guarded = ['id'];
	// Relationship
	public function artist()
	{
		return $this->belongsTo('App\Artist');
	}
    //
	public function getAll() {
		return $this
					->select('works.id as work_id', 'works.name', 'works.img', 'works.slug as work_slug', 'artists.id as artist_id', 'artists.name as artist_name')
					->join('artists', 'works.artist_id', '=', 'artists.id')
					->get();
	}
	public function getOneBySlug($slug)
	{
		return $this->whereSlug($slug)->first();
	}

	//
	public function getOne($id) {
		return $this->find($id);
	}


}
