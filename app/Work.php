<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
	use SoftDeletes;
    //
	public function getAll() {
		return $this
					->select('works.id as work_id', 'works.name', 'works.img', 'artists.id as artist_id', 'artists.name as artist_name')
					->join('artists', 'works.artist_id', '=', 'artists.id')
					->get();
	}

	//
	public function getOne($id) {
		return $this->find($id);
	}


}
