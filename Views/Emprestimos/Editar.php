<div class="container mt-4" style="max-width: 600px;">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
            <h1 class="fw-bold mb-0"><i class="bi bi-pencil-square text-primary"></i> Dar Baixa / Editar Empréstimo</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="index.php?acao=emprestimo_atualizar">

                <input type="hidden" name="id_emprestimo" value="<?= (int)$emp['id_emprestimo'] ?>">

                <div class="mb-3">
                    <label class="form-label fw-bold">Livro Emprestado</label>
                    <select name="id_livro" class="form-select bg-light" required>
                        <?php foreach ($livros as $l): ?>
                            <option value="<?= (int)$l['id_livro'] ?>" <?= ((int)$l['id_livro'] === (int)$emp['id_livro']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($l['titulo']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="emprestado" <?= ($emp['status'] ?? '') === 'emprestado' ? 'selected' : '' ?>>Emprestado</option>
                            <option value="devolvido" <?= ($emp['status'] ?? '') === 'devolvido' ? 'selected' : '' ?>>Devolvido</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <label class="form-label fw-bold">Data de Devolução (Real)</label>
                        <input type="date" name="data_devolucao" class="form-control" value="<?= htmlspecialchars($emp['data_devolucao'] ?? '') ?>">
                        <div class="form-text small">Preencha apenas ao devolver.</div>
                    </div>
                </div>
                <div class="mb-4 p-3 border border-danger border-opacity-25 rounded bg-light">
                    <label class="form-label fw-bold text-danger">
                        <i class="bi bi-wallet2"></i> Pagamento de Multa (Se houver atraso)
                    </label>
                    <select name="forma_pagamento" class="form-select border-danger border-opacity-50">
                        <option value="nenhuma">Sem multa / Isento</option>
                        <option value="pix">PIX</option>
                        <option value="cartao_credito">Cartão de Crédito</option>
                        <option value="cartao_debito">Cartão de Débito</option>
                        <option value="dinheiro">Dinheiro Físico</option>
                    </select>
                    <div class="form-text text-muted">
                        Se o usuário estiver pagando a multa neste momento, registre a forma de pagamento.
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                        <i class="bi bi-save"></i> Salvar Alterações
                    </button>
                    <a href="index.php?acao=emprestimos_listar" class="btn btn-secondary px-4 fw-bold shadow-sm">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>