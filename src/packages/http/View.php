<?php

namespace App\Http;

class View
{
    const VIEWS_FOLDER = __DIR__ . '/../../../resources/';

    public static function load(string $template, array $data = [])
    {
        try {
            $file =  self::VIEWS_FOLDER . strtolower($template) . '.php';
            extract($data);

            include_once($file);
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}
