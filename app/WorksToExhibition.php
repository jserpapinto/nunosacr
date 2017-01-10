<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorksToExhibition extends Model
{
	protected $table = 'works_to_exhibition';
    //


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'featured_to_exhibition'
    ];
}
