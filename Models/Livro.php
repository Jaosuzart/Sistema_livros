<?php
class Livro
{
    private PDO $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function lerTodos()
    {
        $sql = "SELECT l.*,
        (l.quantidade - (
        SELECT COUNT(*) FROM emprestimos e
        WHERE e.id_livro = l.id_livro AND e.status = 'emprestado'
        )) AS disponivel
        FROM livros l ORDER BY l.titulo ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar(string $titulo, string $autor, string $descricao, ?string $capa, ?int $ano): bool
    {
        $sql = "INSERT INTO livros (titulo, autor, descricao, capa, ano)
                VALUES (:titulo, :autor, :descricao, :capa, :ano)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':autor', $autor);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':capa', $capa);
        $stmt->bindValue(':ano', $ano ?? null);
        return $stmt->execute();
    }

    public function atualizar(int $id, string $titulo, string $autor, string $descricao, ?string $capa, ?int $ano): bool
    {
        if ($capa === null) {
            $sql = "UPDATE livros
        SET titulo = :titulo,
            autor = :autor,
            descricao = :descricao,
            ano = :ano
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
        $stmt->bindValue(':ano', $ano);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function listarPorId(int $id): ?array
    {
        $sql = "SELECT * FROM livros WHERE id_livro = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM livros WHERE id_livro = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function buscarPorTitulo($termo)
    {
        // O operador LIKE com os % busca a palavra em qualquer parte do título
        $sql = $sql = "SELECT l.*,
        (l.quantidade - (
        SELECT COUNT(*) FROM emprestimos e
        WHERE e.id_livro = l.id_livro AND e.status = 'emprestado'
        )) AS disponivel
        FROM livros l WHERE l.titulo LIKE :termo ORDER BY l.titulo ASC";;
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':termo', '%' . $termo . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function contarTotal()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM livros");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
