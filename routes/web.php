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


Route::get('/', function () {
    return view('welcome');
});


Route::middleware(
    [
//        "auth:api",
        "cors"
    ]
)->prefix("api/v1")->group(
    function () {
        Route::any("/column/add/table_structure/{name}", "table_structure@items_by_table_structure_name");
        Route::any("/columns/table/{name}", "column@item_by_table_name");
        Route::get("cities", "city@all");
        Route::get("channels", "channel@all");
        Route::get("communities", "community@all");
        Route::get("table_structures", "table_structure@all");
        Route::get("table_structures/plural", "table_structure@all_in_plural");
        Route::get("/table_structure/table_strucutres_in_single_format", "table_structure@table_strucutres_in_single_format");

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
    }
);

