<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    protected $guarded = [];

    public static function add($fields)
    {
        $statistics = new static;
        $statistics->fill($fields);
        $statistics->save();
        return $statistics;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
