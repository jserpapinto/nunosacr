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
		return $this->belongsTo('App\Artist', 'artist_id');
	}
    //
	public function getAll() {
		return $this
					->select('works.id as work_id', 'works.name', 'works.img', 'works.sold', 'works.opportunity', 'works.featured_to_home', 'works.slug', 'artists.id as artist_id', 'artists.name as artist_name', 'artists.slug as artist_slug')
					->join('artists', 'works.artist_id', '=', 'artists.id')
					->get();
	}
	public function getAllOpportunities() {
		return $this->where('opportunity', '=', 1)
					->select('works.id as work_id', 'works.name', 'works.img', 'works.sold', 'works.opportunity', 'works.price', 'works.discount', 'works.featured_to_home', 'works.slug', 'artists.id as artist_id', 'artists.name as artist_name', 'artists.slug as artist_slug')
					->join('artists', 'works.artist_id', '=', 'artists.id')
					->get();
	}
	public function getAllNoOpportunities() {
		return $this->where('opportunity', '=', 0)
					->select('works.id as work_id', 'works.name', 'works.img', 'works.sold', 'works.opportunity', 'works.price', 'works.discount', 'works.featured_to_home', 'works.slug', 'artists.id as artist_id', 'artists.name as artist_name', 'artists.slug as artist_slug')
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
	public function getAllNames() {
		return $this->pluck('name', 'id');
	}

	public function exhibitions()
	{
		return $this->belongsToMany('App\Exhibition', 'works_to_exhibition', 'work_id', 'exhibition_id');
	}


}
