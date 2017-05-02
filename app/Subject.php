<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function level(){
        return $this->belongsTo('App\Level');
    }
    public function specialization(){
        return $this->belongsTo('App\Specialization');
    }
    public function books(){
        return $this->hasMany('App\Book');
    }
}
