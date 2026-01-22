<?php

class Database {
    private array $config;
    public ?PDO $pdo = null;

    public function __construct() {
        // Se o config.php estiver na mesma pasta Config/
        $this->config = require __DIR__ . '/Config.php';
    }

    public function conectar(): PDO {
        try {
            $dsn = "mysql:host={$this->config['host']};dbname={$this->config['dbname']};charset=utf8mb4";

            $this->pdo = new PDO(
                $dsn,
                $this->config['user'],
                $this->config['pass'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );

            return $this->pdo;

        } catch (PDOException $e) {
            die("Erro de conexão com o banco: " . $e->getMessage());
        }
    }
}
