<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function level(){
        return $this->belongsTo('App\Level');
    }
    public function specialization(){
        return $this->belongsTo('App\Specialization');
    }

    public function categoury(){
        return $this->belongsTo('App\Categoury');
    }

    public function subject(){
        return $this->belongsTo('App\Subject');
    }
}
