<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{	
	use SoftDeletes;
    //
	public function getAll() {
		return $this->all();
	}
	public function getAllNames() {
		return $this->pluck('name', 'id');
	}

	//
	public function getOne($id) {
		return $this->find($id);
	}

}
