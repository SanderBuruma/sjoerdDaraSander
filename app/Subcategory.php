<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public function advertenties(){
        return $this->belongsToMany('App\Advertentie');
    }
    public function category(){
        return $this->hasOne('App\Category');
    }
}
