<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Teachers extends Model
{
    protected $fillable = ['photo', 'name', 'surname', 'age', 'subject_en', 'subject_ru', 'subject_uz', 'about_me_en', 'about_me_ru', 'about_me_uz', 'is_visible'
    ];

    public static function add($fields)
    {
        $teacher = new static;
        $teacher->fill($fields);
        $teacher->save();
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
