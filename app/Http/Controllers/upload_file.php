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
            $path = $request->file('file')->store('excel');

            return $this->respond($path);

        } catch (\Throwable $exception) {
            return $this->respond_with_error($exception->getMessage());
        }

    }

    function read_room_init_status_from_excel(Request $request)
    {

        try {
            $path = $request->url;
            $path = Storage::url($path);
            $community_id = (int)$request->community_id;
            \Maatwebsite\Excel\Facades\Excel::load($path, function ($reader) use ($community_id) {
                $reader->skipRows(1)->each(
                    function ($item) use ($community_id) {
                        $id = $item->id;
                        if ($id == "") {
                            return false;
                        }
                        $arr = explode("-", $id);
                        $data = [];
                        $data["community_id"] = $community_id;
                        $data["unit"] = $arr[0]; //楼号
                        $data["entrance"] = $arr[1];//单元
                        $data["number"] = $arr[2];//房号
                        $data["area"] = $item->area;
                        $data["price"] = $item->price;
                        $data["total_price"] = $item->amount;
                        $data["floor"] = substr($data["number"] . "", 0, -2);
                        \App\house::firstOrCreate($data);
                    }
                );
            });

            return $this->respond($path);

        } catch (\Throwable $exception) {
            return $this->respond_with_error(
                $exception->getMessage()
//                "文件操作失败"
            );
        }


    }


}
