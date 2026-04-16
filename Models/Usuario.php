<?php
class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $cpf, $email, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, cpf, email, senha) VALUES (:nome, :cpf, :email, :senha)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);

        return $stmt->execute();
    }
    public function lerTodos() {
        $sql = "SELECT id_usuario, nome, email FROM usuarios ORDER BY nome ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function contarTotal() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM usuarios");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
?>
