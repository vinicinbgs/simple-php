<?php

namespace App\Controllers;

use App\Logging\StoreLog;
use Packages\Http\View;
use Packages\Http\Request;
use Packages\Http\Response;

class HomeController
{
    public function __construct()
    {
        $this->request = new Request();
    }

    public function index()
    {
        $challenger = $this->request->queryParams('challenger');

        View::load($challenger . '/index', [
            'name' => 'Vinicius',
            'styles' => "{$challenger}/styles.css"
        ]);
    }

    public function store()
    {
        $post = $this->request->fields(["name", "age"]);

        sleep(10);

        (new StoreLog($post))->emit();

        return Response::send($post, 200);
    }
}
