<?php

namespace App\utilities;

class Upload
{
    public static function uploadFile($file, $path)
    {
        $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $fileType;
        $fileTmp = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // print_r($file);

        // echo "File Type: " . $fileType . "<br>";
        // echo "File Name: " . $fileName . "<br>";
        // echo "File Temp: " . $fileTmp . "<br>";
        // echo "File Size: " . $fileSize . "<br>";
        // echo "File Error: " . $fileError . "<br>";
        // echo "Path: " . $path . $fileName . "<br>";

        if ($fileError !== 0) {
            return false;
        }

        if ($fileSize > 10000000) {
            return false;
        }

        if (!move_uploaded_file($fileTmp, $path . $fileName)) {
            return false;
        }

        return $fileName;
    }
}
