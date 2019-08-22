<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Residents extends Model
{
    protected $fillable = [
        'place_of_education',
        'direction_code',
        'name',
        'surname',
        'father_name',
        'date_of_birth',
        'citizenship',
        'client_requisite',
        'residential_address',
        'school_region',
        'school_district',
        'school_number_or_name',
        'graduation_year',
        'education_language',
        'certificate_number',
        'act_number',
        'phone',
        'documents_graduate_9_grade'
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
