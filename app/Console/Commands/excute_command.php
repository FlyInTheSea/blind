<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 03/10/17
 * Time: 00:07
 */

namespace App\Console\Commands;


use Illuminate\Support\Facades\Config;

trait excute_command
{


    function change_run_dir()
    {
        chdir(base_path());

        return $this;
    }


    function excute_command($command)
    {


        $result = shell_exec($command);

        $log_path = Config::get("constants.path_log");

        file_put_contents($log_path, $result, FILE_APPEND);
        echo $result;
        echo PHP_EOL;

    }


}