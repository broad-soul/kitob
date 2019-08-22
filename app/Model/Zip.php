<?php
/**
 * Created by PhpStorm.
 * User: sarvar
 * Date: 07.06.2019
 * Time: 9:26
 */

namespace App\Model;

use ZanySoft\Zip\Zip as ZipArchive;

class Zip
{
    public static function create($files)
    {
        $publicUrl = storage_path() . '/app/public/';

        $zipname = str_random(10) . '.zip';
        $zip = ZipArchive::create($publicUrl . $zipname);
        $zip->add($files, true);
        return $zipname;
    }
}
