<?php

namespace App\Http;

class Response
{
    public static function send(array $data = [], int $statusCode = 200)
    {
        header('Content-type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        return;
    }
}
