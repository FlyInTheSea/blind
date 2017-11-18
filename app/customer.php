<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    //
    function customer_owner(){
        return $this->hasOne(customer_owner::class);
    }

}
