<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use \App\Traits\config_data;


Route::get("/tt", function () {
    $path = "excel/oAje8OIdCH649xe8bWGaJmkoVPgp5gPfXdYK81ZY.jpeg";
    $path = "excel/clc.doc";
    return response()->file(
        \Illuminate\Support\Facades\Storage::disk("local")->url($path)
    );


    return response(
        \Illuminate\Support\Facades\Storage::get($path)
    )->withHeaders(
        [
            "Content-type" => "image/jpeg",
            "Content-Length" => \Illuminate\Support\Facades\Storage::size($path)
        ]
    );
});

Route::get("/word", function () {
    $path = "excel/clc.doc";

    return response()->download(
        \Illuminate\Support\Facades\Storage::disk("local")->url($path)
        , "中文.doc");
});


Route::get('/aaa',
    function () {
        $path = "/home/wwwroot/c.sc.cc/excel_template/room_available.xls";
        \Maatwebsite\Excel\Facades\Excel::load($path, function ($reader) {

            $reader->skipRows(1)->each(
                function ($item) {
                    $id = $item->id;
                    try {

                        $arr = explode("-", $id);
                        $data = [];
                        $data["community_id"] = 1;
                        $data["unit"] = $arr[0]; //楼号
                        $data["entrance"] = $arr[1];//单元
                        $data["number"] = $arr[2];//房号
                        $data["area"] = $item->area;
                        $data["price"] = $item->price;
                        $data["total_price"] = $item->amount;
                        $data["floor"] = substr($data["number"] . "", 0, -2);


                        \App\house::firstOrCreate($data);

                    } catch (Throwable $exception) {
                        echo $exception->getMessage();
                    }

                }
            );
            die();
            return $reader->get();

        });
    }
);


Route::middleware(
    [
        "auth:api",
        "cors"
    ]
)->prefix("api/v1")->group(
    function () {


        Route::post("/file/excel", "upload_file@excel");


        Route::get("/overview/community/{community}", "overview@community");


        Route::get("/overview/community/{community}/one_year_sell_station_by_month", "overview@one_year_sell_station_by_month");
        Route::get("/overview/community/{community}/one_year_sell_station_by_day", "overview@one_year_sell_station_by_day");


        Route::get("/overview/community/{community}/sell_station_by_custom_time", "overview@sell_station_by_custom_time");


        Route::get("/overview/community/{community}/one_year_sell_station_by_day", "overview@one_year_sell_station_by_day");


        Route::get("/twelve/community/{community}/district", "overview@community_district_twelve");
        Route::get("/twelve/community/{community}/channel", "overview@community_channel_twelve");
        Route::get("/twelve/community/{community}/sex", "overview@community_sex_twelve");
        Route::get("/twelve/community/{community}/family", "overview@community_family_twelve");
        Route::get("/twelve/community/{community}/house_type", "overview@community_apartment_layout_twelve");
        Route::get("/twelve/community/{community}/motive", "overview@community_motive_twelve");


        Route::get("/overview/community/{community}/district", "overview@community_district");
        Route::get("/overview/community/{community}/channel", "overview@community_channel");
        Route::get("/overview/community/{community}/sex", "overview@community_sex");
        Route::get("/overview/community/{community}/family", "overview@community_family");
        Route::get("/overview/community/{community}/house_type", "overview@community_apartment_layout");
        Route::get("/overview/community/{community}/motive", "overview@community_motive");


        Route::get("/house/{house}/payment", "house@payment");
        Route::get("/commission/user/{user}", "commission@user_commission");
        Route::get("/user/{user}/commission/amount", "commission@user_commission_amount");

        Route::any("/column/add/table_structure/{name}", "table_structure@items_by_table_structure_name");
        Route::any("/columns/table/{name}", "column@item_by_table_name");
        Route::get("cities", "city@all");
        Route::get("channels", "channel@all");
        Route::get("communities", "community@all");
        Route::get("table_structures", "table_structure@all");
        Route::get("table_structures/plural", "table_structure@all_in_plural");
        Route::get("/table_structure/table_strucutres_in_single_format", "table_structure@table_strucutres_in_single_format");

        Route::get("/roles", "role@all");
        Route::get("/users", "user@all");
        Route::get("/permissions", "permission@all");

        Route::resource("customer", "customer");
        Route::resource("city", "city");
        Route::resource("column", "column");
        Route::resource("channel", "channel");
        Route::resource("user", "user");
        Route::resource("community", "community");
        Route::resource("house", "house");
        Route::resource("table_structure", "table_structure");
        Route::resource("daily_report", "daily_report");
        Route::resource("config_transformation", "config_transformation");
        Route::resource("fund", "fund");
        Route::resource("role", "role");

        Route::get("/search/community/word", "community@search");

        $path = \Illuminate\Support\Facades\Config::get("constants.path_route_data");

        $modules = config_data::read_data($path);
        array_map(
            function ($module) {
                Route::resource($module, $module);
            },
            $modules
        );

    }
);


//file_get_contents()

Route::middleware(
    ["cors"]
)->prefix("api/v1")->group(
    function () {
        Route::post("/login", "Auth\LoginController@login");
        Route::get("/login", "Auth\LoginController@index")->name("login");
        Route::get("/register", "Auth\LoginController@index")->name("register");
    }
);

