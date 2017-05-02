<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
   //user relation

public function user()
{
    return $this->belongsTo('App\User');
}

//post relation

public function book()
{
    return $this->belongsTo('App\Book');
}
}
