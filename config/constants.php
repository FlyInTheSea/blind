<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 02/10/17
 * Time: 22:58
 */


//here is front path
return [
    "path_front" => env("PATH_FRONT"),
    "path_api" => env("PATH_FRONT") . "/api",
    "path_container" => env("PATH_FRONT") . "/containers",
    "path_template_id" => env("PATH_FRONT") . "/containers/template/id.js",
    "path_id" => env("PATH_FRONT") . "/containers/%s/id.js",
    "path_template_api_database" => env("PATH_FRONT") . "/api/database/template.js",
    "path_format_api_database" => env("PATH_FRONT") . "/api/database/%s.js",
    "path_switch" => env("PATH_FRONT") ."/components/forms/switch",

    "path_table_map" => env("PATH_FRONT") . "/table_map/table.js",

    // path back end
    "path_log" => app_path("log.log"),
    "path_route_data" => base_path("routes/route.data")


];