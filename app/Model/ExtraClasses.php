<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExtraClasses extends Model
{
    protected $guarded = [];

    public static function add($fields)
    {
        $service = new static;
        $service->fill($fields);
        $service->save();
        return $service;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
