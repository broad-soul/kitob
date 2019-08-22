<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NonResidents extends Model
{
    protected $fillable = [
        'direction_code',
        'name',
        'surname',
        'father_name',
        'date_of_birth',
        'citizenship',
        'client_requisite',
        'residential_address',
        'education_language',
        'phone'
    ];

    public static function add($fields)
    {
        $profiles = new static;
        $profiles->fill($fields);
        $profiles->save();
        return $profiles;
    }

    public function upload($files)
    {
        if(!$files) return;

        $data = Files::add($files);

        $zipname = Zip::create($data['temporaryFilesUrl']);

        $this->name_archive_with_data = $zipname;
        $this->save();

        return $data['filesName'];
    }

}
