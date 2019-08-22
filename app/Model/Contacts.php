<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $fillable = [
        'title_en',
        'title_ru',
        'title_uz',
        'content_en',
        'content_ru',
        'content_uz',
        'map_iframe',
        'phone1',
        'is_visible'
    ];

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
