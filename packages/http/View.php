<?php

namespace Packages\Http;

use Exception;

class View
{
    const VIEWS_FOLDER = __DIR__ . '/../../resources/';

    public static function load(string $template, array $data = [])
    {
        $file =  self::VIEWS_FOLDER . strtolower($template) . '.php';
        extract($data);

        if (!@include_once($file)) {
            throw new Exception("File view not exist");
        }
    }
}
