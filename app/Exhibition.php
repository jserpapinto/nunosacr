<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Exhibition extends Model
{
	use SoftDeletes;
	use Sluggable;
    //

	// sluggable
	public function sluggable()
	{
		return [
            'slug' => [
                'source' => 'title'
            ]
        ];
	}

    public function getAll()
    {
    	return $this->all();
    }
	public function getOneBySlug($slug)
	{
		return $this->whereSlug($slug)->first();
	}  

	public function artists()
	{
		return $this->belongsToMany('App\Artist', 'artist_to_exhibition', 'exhibition_id', 'artist_id');
	}
	public function works()
	{
		return $this->belongsToMany('App\Work', 'works_to_exhibition', 'exhibition_id', 'work_id');
	}
}
