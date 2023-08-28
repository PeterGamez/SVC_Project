<?php

namespace App\Class;

class Api
{
    public static function error_400(): string
    {
        $error = [
            'status' => 400,
            'message' => 'Bad Request'
        ];
        http_response_code(400);
        return json_encode($error);
    }

    public static function error_404($message = null): string
    {
        $error = [
            'status' => 404,
            'message' => $message ?? 'Not Found'
        ];
        http_response_code(404);
        return json_encode($error);
    }

    public static function error_405(): string
    {
        $error = [
            'status' => 405,
            'message' => 'Method Not Allowed'
        ];
        http_response_code(405);
        return json_encode($error);
    }
}
