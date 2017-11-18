<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class permission extends EntrustPermission
{
    //
    protected $guarded = [
        "id",
    ];
}
