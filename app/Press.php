<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Press extends Model
{
	use SoftDeletes;
	protected $table = 'press';
    //
    public function getAll()
    {
    	return $this->all();
    }
	public function getOneBySlug($slug)
	{
		return $this->whereSlug($slug)->first();
	}
}
