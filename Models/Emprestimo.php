<?php
class Emprestimo {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function listarComUsuarioELivro(): array {
        // CORREÇÃO: Adicionado 'e.status' na linha abaixo
        $sql = "SELECT e.id_emprestimo, e.id_usuario, e.id_livro, 
        e.data_devolucao, e.data_prevista_devolucao, e.status,
                       u.nome, u.email,
                       l.titulo, l.capa
                FROM emprestimos e
                JOIN usuarios u ON u.id_usuario = e.id_usuario
                JOIN livros l ON l.id_livro = e.id_livro
                ORDER BY e.id_emprestimo DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM emprestimos WHERE id_emprestimo = :id LIMIT 1");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public function atualizar(int $id, int $id_livro, string $status, ?string $data_devolucao): bool {
        $sql = "UPDATE emprestimos
                SET id_livro = :id_livro,
                    status = :status,
                    data_devolucao = :data_devolucao
                WHERE id_emprestimo = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_livro', $id_livro, PDO::PARAM_INT);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':data_devolucao', $data_devolucao);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}