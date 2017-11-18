<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 11/11/17
 * Time: 12:05
 */

namespace App\Traits;

use Carbon\Carbon;

trait change_timestamp_to_int
{
    function change_js_timestamp_to_Ymd_format($timestamp)
    {
        return (int)Carbon::createFromTimestamp($timestamp / 1000)->format("Ymd");
    }
}
