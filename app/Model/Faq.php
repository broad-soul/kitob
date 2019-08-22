<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';
    protected $guarded = [];

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
