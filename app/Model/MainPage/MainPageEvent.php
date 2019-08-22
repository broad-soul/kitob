<?php

namespace App\Model\MainPage;

use Illuminate\Database\Eloquent\Model;

class MainPageEvent extends Model
{
    protected $table = 'main_page_event';
    protected $fillable = ['title', 'visible', 'bgimage', 'en', 'ru', 'uz'];

    public static function add($fields)
    {
        $about_us = new static;
        $about_us->fill($fields);
        $about_us->save();
        return $about_us;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
