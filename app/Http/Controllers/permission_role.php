<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use App\Http\Controllers\crud\crud;
use Illuminate\Http\Request;

class permission_role extends crud
{
    function store(Request $request)
    {

        $permission_id_str = $request->permission_id;

        $permission_ids = explode(",", $permission_id_str);


        try {

            $role = \App\role::find($request->role_id);
            array_map(
                function ($key, $val) use ($role) {
                    if ($val === "true") {
                        $role->attachPermission($key);
                    }
                },
                array_keys($permission_ids),
                $permission_ids
            );

            return $this->respond($request->all());

        } catch (\Throwable $exception) {

            return $this->respond_with_error($exception->getMessage());

        }

    }
}
