<?php

namespace App\Model\Titles;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $table = 'logo';
    protected $fillable = [
        'bgimage',
        'en',
        'ru',
        'uz'
    ];

    public static function add($fields)
    {
        $logo = new static;
        $image = $fields['new_image'] ?? $fields['image'];
        $logo::query()->delete();
        try {
            $newFile = [
                'bgimage' => $image,
                'en' => $fields['title']['en'],
                'ru' => $fields['title']['ru'],
                'uz' => $fields['title']['uz']
            ];

            $logo::create($newFile);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }
}
