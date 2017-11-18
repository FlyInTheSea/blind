<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use App\Http\Controllers\crud\crud;
use Illuminate\Http\Request;

class config_transformation extends crud
{
    //
    function show($config_transformation)
    {
        list($table_structure_id,$column_id) = explode("_",$config_transformation);
        $config_transformation = new \App\config_transformation();
        return $this->respond($config_transformation->one_column_options($table_structure_id, $column_id)->get());
    }

}
