<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use DB;
use Config;

class Work extends Model
{
	// Use column deleted_at from database instead of fully deleting item
	use SoftDeletes;
	use Sluggable;
	// sluggable
	public function sluggable()
	{
		return [
            'slug' => [
                'source' => 'name'
            ]
        ];
	}
	// protects against mass assign
	protected $guarded = ['id'];
	// Relationship
	public function artist()
	{
		return $this->belongsTo('App\Artist', 'artist_id');
	}
    //
	public function getAll() {
		return DB::select('CALL works_all()');
	}
	public function getAllOpportunities() {
		return DB::select('CALL works_all_opportunities('.Config::get('const.OPPORTUNITIES').')');
	}
	public function getAllNoOpportunities() {
		return DB::select('CALL works_all_opportunities('.Config::get('const.NO_OPPORTUNITIES').')');
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
