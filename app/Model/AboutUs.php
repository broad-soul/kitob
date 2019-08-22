<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';
    protected $guarded = [];

    public static function add($fields)
    {
        $about_us = new static;
        $about_us::query()->delete();
        $about_us->fill($fields);
        $about_us->save();
        return $about_us;
    }
}
