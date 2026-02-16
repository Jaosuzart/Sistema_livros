<?php
class Livro {
    private PDO $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function lerTodos() {
        $sql = "SELECT * FROM livros ORDER BY id_livro DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function criar(string $titulo, string $autor, string $descricao, ?string $capa, ?string $link): bool {
        $sql = "INSERT INTO livros (titulo, autor, descricao, capa, link)
                VALUES (:titulo, :autor, :descricao, :capa, :link)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':autor', $autor);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':capa', $capa);
        $stmt->bindValue(':ano', $ano ?? null);
        return $stmt->execute();
    }

    public function atualizar(int $id, string $titulo, string $autor, string $descricao, ?string $capa, ?string $link, ?int $ano): bool {
        if ($capa === null) {
            $sql = "UPDATE livros
                    SET titulo = :titulo,
                        autor = :autor,
                        descricao = :descricao,
                        link = :link
                    WHERE id_livro = :id";
            $stmt = $this->conn->prepare($sql);
        } else {
            $sql = "UPDATE livros
                    SET titulo = :titulo,
                        autor = :autor,
                        descricao = :descricao,
                        capa = :capa,
                        link = :link
                    WHERE id_livro = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':capa', $capa);
        }

        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':autor', $autor);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':link', $link);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function listarPorId(int $id): ?array {
        $sql = "SELECT * FROM livros WHERE id_livro = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public function deletar(int $id): bool {
        $sql = "DELETE FROM livros WHERE id_livro = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
