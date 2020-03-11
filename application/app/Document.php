<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;


class Document extends Model
{
    use SoftDeletes;

    protected $table = 'document';
    protected $dates = ['deleted_at'];
    protected $fillable = [

    	'reference_number','job_number','date','box_id','description','user_id'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function box()
    {
    	return $this->belongsTo('App\Box');
    }

    public function contain()
    {
        return $this->belongsToMany('App\Contain');
    }

    public function file()
    {
        return $this->hasMany('App\File');
    }

    public static function ref_number($date_input)
    {
        
        $document = Document::whereMonth('date', date("m",strtotime($date_input)))->count();
        $company = 'KHZ';
        $bulanRomawi =  ["", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII"];
        
        $fix_ref_number = sprintf("%04s",abs($document + 1)).'-'.$company.'/'.$bulanRomawi[date('n',strtotime($date_input))].'/'.date('Y', strtotime($date_input));

        return $fix_ref_number;
    }

}
