<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Advertentie extends Model
{
    use Notifiable;
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function category(){
        return $this->hasOne('App\Subcategory');
    }
}
