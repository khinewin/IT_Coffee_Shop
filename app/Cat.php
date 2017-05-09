<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    public function coffee(){
        return $this->hasMany('App\Coffee');
    }
}
