<?php

namespace App\Controllers;

use App\Logging\StoreLog;
use Packages\Http\View;
use Packages\Http\Request;
use Packages\Http\Response;

use PDO;

use vinicinbgs\Autentique\Documents;

use App\Controllers\BaseController;
use App\Exceptions\FirstException;
use Exception;

class HomeController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct();

        $this->request = $request;
    }

    public function index()
    {
        $challenger = $this->request->queryParams('challenger');
        $this->db();
        View::load($challenger . '/index', [
            'name' => 'Vinicius',
            'styles' => "{$challenger}/styles.css"
        ]);
    }

    private function db()
    {
        $pdo = new PDO(
            'mysql:host=db;port=3306;dbname=teste',
            'root',
            'root'
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->exec("INSERT INTO testinhox (id) VALUES (1);");

        unset($pdo);

        throw new FirstException("Hello", 400);
    }

    public function store()
    {
        $post = $this->request->fields(["name", "age"]);
        $this->db();
        // $documents = new Documents();

        // $docs = $documents->create([
        //     'document' => [
        //         'name' => 'NOME DO DOCUMENTO',
        //     ],
        //     'signers' => [
        //         [
        //             'email' => 'email@email.com',
        //             'action' => 'SIGN',
        //             'positions' => [
        //                 [
        //                     'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
        //                     'y' => '80', // Posição do Eixo Y da ASSINATURA (0 a 100)
        //                     'z' => '1', // Página da ASSINATURA
        //                 ],
        //                 [
        //                     'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
        //                     'y' => '50', // Posição do Eixo Y da ASSINATURA (0 a 100)
        //                     'z' => '2', // Página da ASSINATURA
        //                 ],
        //             ],
        //         ],
        //         [
        //             'email' => 'email@email.com',
        //             'action' => 'SIGN',
        //             'positions' => [
        //                 [
        //                     'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
        //                     'y' => '80', // Posição do Eixo Y da ASSINATURA (0 a 100)
        //                     'z' => '1', // Página da ASSINATURA
        //                 ],
        //                 [
        //                     'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
        //                     'y' => '50', // Posição do Eixo Y da ASSINATURA (0 a 100)
        //                     'z' => '2', // Página da ASSINATURA
        //                 ],
        //             ],
        //         ],
        //     ],
        //     'file' => __DIR__ . '/../../log.pdf',
        // ]);

        // (new StoreLog($docs))->emit();

        return Response::send([], 200);
    }
}
