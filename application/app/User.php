<?php

namespace App;

use Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends  Authenticatable
{
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'name', 'email', 'password','division_id', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function document()
    {
        return $this->hasMany(Document::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function division()
    {
        return $this->belongsTo('App\Division');
    }

    public function authorizeRoles($roles)
    {
        if(is_array($roles))
        {
            return $this->hasAnyRole($roles) || abort('401','This action unauthorized!');
        }

        return $this->hasRole($roles) || abort('401','This action unauthorized!');
    }

 
    // public function hasAnyRole($roles)
    // {
    //     return null !== $this->roles()->whereIn('name',$roles)->first();
    // }


    // public function hasRole($role)
    // {
    //     return null !== $this->roles()->where('name',$role)->first();
    // }

    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->id);
    }


}
