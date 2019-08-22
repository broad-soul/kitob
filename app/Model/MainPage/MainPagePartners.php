<?php

namespace App\Model\MainPage;

use Illuminate\Database\Eloquent\Model;

class MainPagePartners extends Model
{
    protected $table = 'main_page_partners';
    protected $fillable = ['title', 'visible', 'bgimage', 'content_en', 'content_ru', 'content_uz'];

    public static function add($fields)
    {
        $partners = new static;
        $partners->fill($fields);
        $partners->save();
        return $partners;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
