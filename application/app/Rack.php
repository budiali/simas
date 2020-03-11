<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Rack extends Model
{
    use HasRoles;
    protected $table = 'rack';

    protected $fillable = ['rack_number','capacity','division_id'];

    public function division()
    {
        return $this -> belongsTo('App\Division');
    }

    public function box()
    {
        return $this -> hasMany('App\Box');
    }
}
