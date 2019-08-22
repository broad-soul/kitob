<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InstructionApp extends Model
{
    protected $table = 'instruction_applications';
    protected $fillable = [
        'title_en',
        'title_ru',
        'title_uz',
        'content_en',
        'content_ru',
        'content_uz',
        'is_resident'
    ];

    public static function add($fields)
    {
        $app = new static;
        $app->fill($fields);
        $app->save();
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
