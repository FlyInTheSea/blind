<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use Illuminate\Http\Request;

class user extends api
{
    function index(Request $request)
    {
        try {
            $data = \App\User::where(
                []
            )
                ->orderBy("created_at", "desc")
                ->paginate();
            if ( ! $data) {
                return $this->respond_not_found();
            }
            return $this->respond($data);
        } catch (\Throwable $exception) {
            return $this->respond_with_error($exception->getMessage());
        }
    }

    function all()
    {
        $data = \App\User::all()->all();
        $data = array_map(function ($item) {
            return [
                "id" => $item["id"],
                "name" => $item["name"]
            ];
        }, $data);
        return
            $this->respond(
                $data
            );
    }


    function store(Request $request)
    {

        try {

            $user = new \App\User();

            $user->name = $request->name;

            $user->email = $request->email;

            $user->phone = $request->phone;

            $user->save();

            $user->attachRole((int)$request->role_id);

            return $this->respond($user);

        } catch (\Throwable $exception) {

            return $this->respond($exception->getMessage());

        }

    }

    /**
     * function index(Request $request)
     * {
     * try {
     * $data = ($this->class)::where(
     * []
     * )
     * ->orderBy("created_at", "desc")
     * ->paginate();
     * if (!$data)
     * return $this->respond_not_found();
     * return $this->respond($data);
     * } catch (\Throwable $exception) {
     * return $this->respond_with_error($exception->getMessage());
     * }
     *
     * }
     * @param Request $request
     * @return mixed
     */
}
