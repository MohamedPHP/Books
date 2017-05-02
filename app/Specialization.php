<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    public function books(){
        return $this->hasMany('App\Book');
    }
    public function users(){
        return $this->hasMany('App\User');
    }
    public function subjects(){
        return $this->hasMany('App\Subject');
    }
}
