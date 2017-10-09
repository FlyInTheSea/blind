<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table_structure extends Model
{
    protected $guarded = [
        "id",
    ];

    //
    function columns()
    {
        return $this->hasMany("App\column");
    }
}
