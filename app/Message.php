<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Message extends Model
{    
    use Notifiable;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
