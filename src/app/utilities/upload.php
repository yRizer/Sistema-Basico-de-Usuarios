<?php

namespace App\utilities;

class Upload
{
    public static function uploadFile($file, $path)
    {
        // A extensão vem do conteúdo real do arquivo, nunca do nome enviado,
        // para impedir o upload de scripts disfarçados de imagem.
        $allowed = [
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG => 'png',
        ];

        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return false;
        }

        $imageInfo = @getimagesize($file['tmp_name']);
        if ($imageInfo === false || !isset($allowed[$imageInfo[2]])) {
            return false;
        }

        $fileName = bin2hex(random_bytes(16)) . '.' . $allowed[$imageInfo[2]];
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
