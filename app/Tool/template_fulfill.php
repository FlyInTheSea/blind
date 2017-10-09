<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 05/10/17
 * Time: 13:56
 */

namespace App\Tool;


use App\Console\Commands\excute_command;

class template_fulfill
{
    use excute_command;

    function fulfill($template_path, $target_path, $search, $replace)
    {
        $content = file_get_contents($template_path);

        $put_content = str_replace($content, $search, $replace);

        file_put_contents($target_path, $put_content);

        return $this;
    }

    function insert_file($path, $search, $content)
    {


        $search = preg_quote($search);
        // 替换　" /
        $search = str_replace(["\"", "/"
        ], ["\\\"", "\/"
        ], $search);

        // 反向替换 /{ }/
        $search = str_replace([
            "\\{", "\\}","\\<","\\>"
        ], [
            "{", "}","<",">"
        ], $search);
        // 替换　" /
        $content = str_replace(["\"", "/"], ["\\\"", "\\/"], $content);


        $command = "sed -i '/{$search}/i $content' {$path} ";

        echo $command . PHP_EOL;

        $this->excute_command($command);

        return $this;
    }

}
