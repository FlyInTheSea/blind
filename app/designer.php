<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class designer extends Model
{
    //
    protected $table = "designer";

    function city()
    {
        return $this->belongsTo("App\city", "CID");
    }
}
