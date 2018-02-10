<?php

namespace App\Http\Controllers;

use App\Http\Controllers\crud\crud;
use Illuminate\Http\Request;

class customer_info extends crud
{
    //
//    public
    public function createOrUpdate(Request $request)
    {

        $data = $request->except(["_method", "s", "deleted_at"]);
        try {
            $obj = new ($this->class)($data);
            return $this->respond($obj);
        } catch (\Exception $exception) {
            return $this->respond_with_error($exception->getMessage());
        }

    }
}
