<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = 'box';

    protected $fillable = ['box_number','to','from','rack_id'];

    public function document()
    {
    	return $this->hasMany('App\Document');
    }

    public function rack()
    {
        return $this->belongsTo('App\Rack');
    }
}
