<?php
class Emprestimo {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function listarComUsuarioELivro(): array {
        // CORREÇÃO: Adicionado 'e.status' na linha abaixo
        $sql = "SELECT e.id_emprestimo, e.id_usuario, e.id_livro, 
        e.data_devolucao, e.data_prevista_devolucao, e.status, e.forma_pagamento,
                       u.nome, u.email,
                       l.titulo, l.capa, l.quantidade_total
                FROM emprestimos e
                JOIN usuarios u ON u.id_usuario = e.id_usuario
                JOIN livros l ON l.id_livro = e.id_livro
                ORDER BY e.id_emprestimo DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
public function lerPorUsuário(int $id_usuario): array {
 $sql = "SELECT e.id_emprestimo, e.id_usuario, e.id_livro, 
        e.data_devolucao, e.data_prevista_devolucao, e.status, e.forma_pagamento,
                       u.nome, u.email,
                       l.titulo, l.capa, l.quantidade
                FROM emprestimos e
                JOIN usuarios u ON u.id_usuario = e.id_usuario
                JOIN livros l ON l.id_livro = e.id_livro
                WHERE e.id_usuario = :id_usuario
                ORDER BY e.id_emprestimo ASC";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
    public function buscarPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM emprestimos WHERE id_emprestimo = :id LIMIT 1");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public function atualizar(int $id, int $id_livro, string $status, ?string $data_devolucao, string $forma_pagamento = 'nenhuma'): bool {
        $sql = "UPDATE emprestimos
                SET id_livro = :id_livro,
                    status = :status,
                    data_devolucao = :data_devolucao,
                    forma_pagamento = :forma_pagamento
                WHERE id_emprestimo = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_livro', $id_livro, PDO::PARAM_INT);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':data_devolucao', $data_devolucao);
        $stmt->bindValue(':forma_pagamento', $forma_pagamento);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function cadastrar($id_livro, $id_usuario, $data_prevista) {
        $sql = "INSERT INTO emprestimos (id_livro, id_usuario, data_prevista_devolucao, status) 
                VALUES (:id_livro, :id_usuario, :data_prevista, 'emprestado')";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_livro', $id_livro, PDO::PARAM_INT);
        $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindValue(':data_prevista', $data_prevista);
        
        return $stmt->execute();
    }
    public function contarPorStatus($status) {
        // Atenção: Aqui usamos $this->db porque é assim que está no seu arquivo Emprestimo
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM emprestimos WHERE status = :status");
        $stmt->bindValue(':status', $status);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function verificarBloqueioUsuario(int $id_usuario): bool {
        // Conta quantos livros o usuário tem emprestado E que a data já passou de hoje
        $sql = "SELECT COUNT(*) FROM emprestimos 
                WHERE id_usuario = :id_usuario 
                AND status = 'emprestado' 
                AND data_prevista_devolucao < CURDATE()";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        
        $atrasos = $stmt->fetchColumn();
        
        return $atrasos > 0; // Se for maior que zero, retorna VERDADEIRO (está bloqueado)
    }
    public function lerMultasPendentes() {
        // O DATEDIFF calcula a diferença de dias. Multiplicamos por 2 para o valor em Reais!
        $sql = "SELECT u.nome, u.email, l.titulo,
                       DATEDIFF(CURDATE(), e.data_prevista_devolucao) AS dias_atraso,
                       (DATEDIFF(CURDATE(), e.data_prevista_devolucao) * 2.00) AS valor_multa
                FROM emprestimos e
                JOIN usuarios u ON e.id_usuario = u.id_usuario
                JOIN livros l ON e.id_livro = l.id_livro
                WHERE e.status = 'emprestado' 
                AND e.data_prevista_devolucao < CURDATE()
                ORDER BY valor_multa DESC";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    }