<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'file';
    protected $fillable = ['document_id','filename'];

    public function document()
    {
    	return $this->belongsTo('App\Document');
    }
}
