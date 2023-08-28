<?php

namespace App\Class;

class Download
{
    final public static function transfer(string $file, string $filename): void
    {
        ob_start();
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Expires: 60');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        $handle = fopen($file, 'rb');
        fpassthru($handle);
        fclose($handle);

        ob_end_flush();
    }
}
