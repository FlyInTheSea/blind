<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class casedecorate extends Model
{
    //
    protected $table = "casedecorate";

    function city()
    {
        return $this->belongsTo("App\city", "cityID");
    }
}
