<?php

namespace Packages\Database;

use Exception;
use PDO;

use App\Exceptions\DatabaseException;

class Connect
{
    private array $connection;

    private array $configs;

    private $pdo;

    public function __call($method, $arguments)
    {
        return $this->wrapper($method, $arguments);
    }

    public function __construct()
    {
        $this->configs = require __DIR__ . '../../../src/config/databases.php';
        $default = $this->configs['default'];
        $this->connection = $this->configs['connections'][$default];
    }

    protected function conn()
    {
        $connectionDTO = new ConnectionDTO($this->connection);

        $this->pdo = new PDO(
            $connectionDTO->getConnectionString(),
            $connectionDTO->user,
            $connectionDTO->password
        );

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this;
    }

    protected function insert()
    {
        return $this->pdo->exec("INSERT INTO testinhox (id) VALUES (1000);");
    }

    private function wrapper($func, $arguments)
    {
        try {
            return $this->$func($arguments);
        } catch (Exception $e) {
            throw new DatabaseException("[database]: " . $e->getMessage(), 403);
        }
    }
}
