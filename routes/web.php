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

use App\Traits\config_data;
use App\User;
use Illuminate\Support\Facades\Gate;

Route::get("te", function () {
//    var_dump(User::find(3)->role_user instanceof \App\models\role_user);
    return User::find(3)->role_user->role;
});
Route::get("ab", function () {
    Gate::allows("ax");
    return "aa";
});

Route::get("aa", function (\App\house $house) {
    try {
        throw new Exception("想象力　贫穷");
    } catch (Throwable $exception) {
        report($exception);
    }
//    throw  new Error("fuck");
    return "fanhuizhi";
});

Route::get("test/{house}", function (\App\house $house) {

});

Route::get("/word", function () {
    $path = "excel/clc.doc";

    return response()->download(
        \Illuminate\Support\Facades\Storage::disk("local")->url($path)
        , "中文.doc");
});

Route::get("/overview/community/{community}/sell_station_by_custom", "overview@sell_station_by_custom");
Route::middleware(
    [
        "auth:api",
        "cors",
        "can:action_is_in_mine_allowed_list," . User::class
    ]
)->prefix("api/v1")->group(
    function () {

        Route::post("aa", function (\Faker\Generator $faker) {
            echo "success";
            return 11;
        });
        Route::post("/file/excel", "upload_file@excel");

        Route::post("/room_status/load_from_excel", "upload_file@read_room_init_status_from_excel");

        Route::get("/overview/community/{community}", "overview@community");

        Route::get("/overview/community/{community}/sell_station_by_custom", "overview@sell_station_by_custom");

        Route::get("/overview/community/{community}/one_year_sell_station_by_month",
            "overview@one_year_sell_station_by_month");
        Route::get("/overview/community/{community}/one_year_sell_station_by_day",
            "overview@one_year_sell_station_by_day");
        Route::get("/overview/community/{community}/sell_station_by_custom_time",
            "overview@sell_station_by_custom_time");
        Route::get("/overview/community/{community}/one_year_sell_station_by_day",
            "overview@one_year_sell_station_by_day");

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
        Route::get("/contract/{house}/summaries", "contract@summaries");
        Route::get("/commission/user/{user}", "commission@user_commission");
        Route::get("/user/{user}/commission/amount", "commission@user_commission_amount");

        Route::any("/column/add/table_structure/{name}", "table_structure@items_by_table_structure_name");
        Route::any("/columns/table/{name}", "column@item_by_table_name");
        Route::get("cities", "city@all");
        Route::get("channels", "channel@all");
        Route::get("communities", "community@all");
        Route::get("table_structures", "table_structure@all");
        Route::get("table_structures/plural", "table_structure@all_in_plural");
        Route::get("/table_structure/table_strucutres_in_single_format",
            "table_structure@table_strucutres_in_single_format");

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
        Route::resource("contract_template", "contract_template");

        Route::get("/search/community/word", "community@search");
        Route::get("/print_img/fund/{fund}", "print_img@fund");

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

Route::middleware(
    ["cors"]
)->prefix("api/v1")->group(
    function () {
        Route::post("/login", "Auth\LoginController@login");
        Route::get("/login", "Auth\LoginController@index")->name("login");
        Route::get("/register", "Auth\LoginController@index")->name("register");
    }
);

