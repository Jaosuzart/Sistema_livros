<?php

class Database {
    public ?PDO $pdo = null;

    public function __construct() {
        require_once __DIR__ . '/Config.php'; // carrega as constantes
    }

    public function conectar(): PDO {
        try {
            $dsn = "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8mb4";

            $this->pdo = new PDO(
                $dsn,
                MYSQL_USERNAME,
                MYSQL_PASSWORD,
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