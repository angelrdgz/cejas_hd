<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engagement extends Model
{
    public function service(){
        return $this->belongsTo('App\Service');
    }

    public function branch(){
        return $this->belongsTo('App\Branch');
    }

    public function adviser(){
        return $this->belongsTo('App\User', 'adviser_id', 'id');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }
}
