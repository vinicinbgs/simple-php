<?php

namespace Packages\Database;

class ConnectionDTO
{
    public string $driver;
    public string $host;
    public string $port;
    public string $db;
    public string $user;
    public string $password;

    public function __construct(array $attributes)
    {
        $this->mountDTO($attributes);
    }

    public function getConnectionString(): string
    {
        return "{$this->driver}:host={$this->host};port={$this->port};dbname={$this->db}";
    }

    protected function mountDTO(array $attributes)
    {
        $this->driver = $attributes['driver'];
        $this->host = $attributes['host'];
        $this->port = $attributes['port'];
        $this->db = $attributes['db'];
        $this->user = $attributes['user'];
        $this->password = $attributes['password'];
    }
}
