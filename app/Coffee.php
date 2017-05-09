<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coffee extends Model
{
    public static function SearchByKeyword($coffee)
    {
    }

    public function cat(){
        return $this->belongsTo('App\Cat');
    }
}
