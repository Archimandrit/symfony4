<?php


namespace App\Helpers;


class FileHelper
{

    const UPLOAD_DIR = ROOT_DIR.'assets/uploads/';

    public static function getExtension(string $filename)
    {
        $explodeFilename = explode('.', $filename);
        return $explodeFilename[count($explodeFilename)-1];
    }

}