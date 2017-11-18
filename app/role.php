<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class role extends EntrustRole
{
    protected $guarded = [
        "id",
    ];
    //
}
