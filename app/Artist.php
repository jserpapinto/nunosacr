<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{	

    //
	public function getAll() {
		return $this->all();
	}

}
