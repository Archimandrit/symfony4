<?php


namespace App\Helpers;


class FileHelper
{

    const UPLOAD_DIR = __DIR__.'/../../assets/uploads/';

    public static function getExtension(string $filename)
    {
        $explodeFilename = explode('.', $filename);
        return $explodeFilename[count($explodeFilename)-1];
    }

}