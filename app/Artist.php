<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{	

    //
	public function getAll() {
		return $this->all();
	}

	//
	public function getOne($id) {
		return $this->find($id);
	}

}
