<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'division';

    protected $fillable = ['name','descriptions'];

    public function rack()
    {
        return $this -> hasMany('App\Rack');
    }

    public function user()
    {
    	return $this->hasMany('App\User');
    }
}
