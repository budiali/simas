<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contain extends Model
{
	protected $table = 'contains';
	
    protected $fillable = ['name'];

    public function document()
    {
    	return $this->belongsToMany('App\Document');
    }
}
