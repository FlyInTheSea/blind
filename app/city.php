<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{

//    function casedecorates(){
//        return $this->hasMany("App\casedecorate","cityid");
//    }

    protected $guarded = [
        "id",
    ];
}
