<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class house_owner extends Model
{
    //

    function customer(){
        return $this->belongsTo(customer::class);
    }


}
