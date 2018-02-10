<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class role_user extends Model
{
    //

    function role()
    {
        return $this->belongsTo(Role::class);
    }
}
