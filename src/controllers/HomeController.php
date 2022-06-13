<?php

namespace App\Controllers;

use App\Http\View;
use App\Http\Request;
use App\Http\Response;

class HomeController
{
    public function __construct()
    {
        $this->request = new Request();
    }

    public function index()
    {
        $challenger = $this->request->get('challenger');

        View::load($challenger . '/index', [
            'name' => 'Vinicius',
            'styles' => 'day-04/styles.css'
        ]);
    }

    public function store()
    {
        if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
            $post = json_decode(file_get_contents('php://input', 'r'), true);
        } else {
            parse_str(file_get_contents("php://input"), $post);
        }

        return Response::send($post);
    }
}
