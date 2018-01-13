<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class print_img extends Controller
{

    public $font_size = 20;
    function fund()
    {


        $img = \Intervention\Image\Facades\Image::make(
            \Illuminate\Support\Facades\Storage::disk("public")->url("receipt.jpg")
        );
        $num = 1002042;
        $num_str = number2chinese($num, true);
        $name = "杨益民";
        $phone = "13121341474";
        $addr = "沧州运河区11号";
        $date = \Carbon\Carbon::now()->format("Y-m-d");
        $charger = "收费员";

        $img->text($num_str, 270, 405, function ($font) {
            $font->file(FONT_PATH);
            $font->size($this->font_size);
        });

        $img->text($num, 780, 405, function ($font) {
            $font->file(FONT_PATH);
            $font->size($this->font_size);
        });

        $img->text($name, 270, 220, function ($font) {
            $font->file(FONT_PATH);
            $font->size($this->font_size);
        });
        $img->text($phone, 430, 220, function ($font) {
            $font->file(FONT_PATH);
            $font->size($this->font_size);
        });

        $img->text($addr, 620, 220, function ($font) {
            $font->file(FONT_PATH);
            $font->size($this->font_size);
        });
        $img->text($date, 710, 165, function ($font) {
            $font->file(FONT_PATH);
            $font->size($this->font_size);
        });
        $img->text($charger, 594, 530, function ($font) {
            $font->file(FONT_PATH);
            $font->size($this->font_size);
        });

        return $img->response();
    }
}
