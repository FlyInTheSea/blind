<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbfitmentguide extends Model
{
    //
    protected $table = "tbfitmentguide";

    function city()
    {
        return $this->belongsTo("App\city", "CityId");
    }
}
