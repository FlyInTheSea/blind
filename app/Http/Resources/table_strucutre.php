<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class table_strucutre extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {

        return [
            "id"=>$this->id,
            "name_alias" => $this->name_alias,
            "name" => str_singular($this->name)
        ];
    }
}
