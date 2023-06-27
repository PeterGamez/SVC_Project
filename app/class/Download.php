<?php
class Download
{
    public static function transfer($file, $filename)
    {
        ob_start();
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Expires: 60');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        ob_end_flush();
        return;
    }
}
