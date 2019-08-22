<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contests extends Model
{
    protected $guarded = [];

    public static function add($fields)
    {
        $contests = new static;
        $contests->fill($fields);
        $contests->save();
        return $contests;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
