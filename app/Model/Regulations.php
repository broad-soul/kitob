<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Regulations extends Model
{
    protected $guarded = [];

    public static function add($fields)
    {
        $regulations = new static;
        $regulations->fill($fields);
        $regulations->save();
        return $regulations;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
