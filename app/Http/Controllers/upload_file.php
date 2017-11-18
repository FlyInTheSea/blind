<?php

namespace App\Http\Controllers;

use App\Http\Controllers\crud\crud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class upload_file extends crud
{

    function excel(Request $request)
    {


        try {
            $path = $request->file('file')->store('excel',"public");

            $path = Storage::url($path);
            return $this->respond($path);

        } catch (\Throwable $exception) {
            return $this->respond_with_error($exception->getMessage());
        }

    }

}
