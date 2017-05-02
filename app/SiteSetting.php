<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
   protected $fillable = [
      'slug', 'nameSetting', 'value', 'type'
   ];
}
