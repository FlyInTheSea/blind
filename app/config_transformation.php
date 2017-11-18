<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class config_transformation extends Model
{
    //
    protected $guarded = [
        "id"
    ];


    function one_column_options($table_structure_id, $column_id)
    {
        return $this->where(
            "table_structure_id"
            , "=", $table_structure_id
        )->where(
            "column_id"
            , "=", $column_id
        );
    }
}
