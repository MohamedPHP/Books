<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     // 'name', 'email', 'password', 'download_limit', 'address', 'phonenumber',
     // 'generated_id', 'type', 'level_id', 'specialization_id'
    protected $fillable = [
        'name', 'email', 'password', 'download_limit', 'address', 'phonenumber','student_id', 'type', 'level_id', 'specialization_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function level(){
        return $this->belongsTo('App\Level');
    }
    public function specialization(){
        return $this->belongsTo('App\Specialization');
    }

    // books relations
    public function books()
    {
         return $this->hasMany("App\Book");
    }

    // like relations
    public function rates()
    {
         return $this->hasMany("App\Rate");
    }

    public function downloads()
    {
         return $this->hasMany("App\Download");
    }

}
