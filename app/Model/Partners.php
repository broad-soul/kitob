<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    protected $guarded = [];

    public static function add($fields)
    {
        $event = new static;
        $event->fill($fields);
        $event->save();
        return $event;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
