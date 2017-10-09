<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 03/10/17
 * Time: 19:56
 */


namespace App\Traits;

use Mockery\Exception;

trait config_data
{
    static function read_data($path)
    {
        $str = file_get_contents($path);

        $con = explode(",", $str);

        return $con;
    }

    public function write_data($path, $data)
    {
        $str = file_get_contents($path);

        $con = explode(",", $str);

        if($con[0] === ""){
            unset($con[0]);
        }

        if (array_search($data, $con)) {
            throw new Exception("该模块已经存在".PHP_EOL);
        }

        $con[] = $data;

        $str = implode(",", $con);

        $re = file_put_contents($path, $str);

        return $this;

    }

}