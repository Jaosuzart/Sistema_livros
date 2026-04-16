<div class="container mt-4" style="max-width: 600px;">
    <div class="card-shadow-sm border-0">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
     <h1 class="fs-2 fw-bold mb-0"><i class="bi bi-plus-circle text-success"></i>Novo Empréstimo</h2>
    </div>
    <div class="card-body">
        <?php if (isset($_GET['erro']) && $_GET['erro'] === 'bloqueado'): ?>
                <div class="alert alert-danger shadow-sm border-0 d-flex align-items-center">
                    <i class="bi bi-exclamation-octagon-fill fs-3 me-3"></i>
                    <div>
                        <strong>Empréstimo Bloqueado!</strong><br>
                        Este usuário possui livros em atraso e não pode realizar novos empréstimos até efetuar a devolução e pagar a multa.
                    </div>
                </div>
            <?php endif; ?>
        <form  method="POST"action="index.php?acao=emprestimo_salvar">
            <div class="mb-3">
            <label class="form-label fw-bold">Selecione o Livro</label>
            <select name="id_livro" class="form-select bg-light" required>
                <option value="">Escolha um livro...</option>
                <?php foreach($livros as $l):?>
                    <option value="<?= (int)$l['id_livro'] ?>">
                        <?= htmlspecialchars($l['titulo']) ?>
                    </option>
                    <?php endforeach;?>
            </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Selecione o Usuário</label>
                <select name="id_usuario" class="form-select bg-light" required>
                <option value="">Para quem é o empréstimo</option>
                <?php foreach ($usuarios as $u): ?>
                            <option value="<?= (int)$u['id_usuario'] ?>">
                                <?= htmlspecialchars($u['nome'] ?? $u['email']) ?>
                            </option>
                        <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Data Prevista para Devolução</label>
                <input type="date" name="data_prevista_devolucao" class="form-control" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success px-4 fw-bold shadow-sm">
                    <i class="bi bi-check-lg"></i> Registrar Empréstimo
                </button>
                <a href="index.php?acao=emprestimo_listar" class="btn btn-secondary px-4 fw-bold shadow-sm">Cancelar</a>

            </div>
        </form>
    </div>
    </div>
</div>