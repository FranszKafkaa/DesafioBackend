<?php

namespace Src\Database;

use \PDO;

class DatabaseConnection
{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $pdo;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->db = $_ENV['DB_DATABASE'];
        $this->user = $_ENV['DB_USERNAME'];
        $this->pass = $_ENV['DB_PASSWORD'];


        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=utf8mb4";
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception('Erro ao conectar com o banco de dados: ' . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
