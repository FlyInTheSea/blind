<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class column extends Model
{

//    protected $fillable = [
//        "table_structure_id",
//        "name",
//        "sort_id",
//        "writable",
//        "type",
//        "name_alias"
//    ];

    protected $guarded = [
        "id",
    ];

    function table_structure()
    {
        return $this->belongsTo("App\Column");
    }

}
