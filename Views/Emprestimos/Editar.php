<div class="container mt-4" style="max-width: 600px;">
  <h2>Editar Empréstimo</h2>

  <form method="POST" action="index.php?acao=emprestimo_atualizar">
    <input type="hidden" name="id_emprestimo" value="<?php echo (int)$emp['id_emprestimo']; ?>">

    <div class="mb-3">
      <label class="form-label">Livro</label>
      <select name="id_livro" class="form-select" required>
        <?php foreach ($livros as $l): ?>
          <option value="<?php echo (int)$l['id_livro']; ?>"
            <?php echo ((int)$l['id_livro'] === (int)$emp['id_livro']) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($l['titulo']); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="emprestado" <?php echo ($emp['status'] ?? '') === 'emprestado' ? 'selected' : ''; ?>>Emprestado</option>
        <option value="devolvido" <?php echo ($emp['status'] ?? '') === 'devolvido' ? 'selected' : ''; ?>>Devolvido</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Data de devolução</label>
      <input type="date" name="data_devolucao" class="form-control"
             value="<?php echo htmlspecialchars($emp['data_devolucao'] ?? ''); ?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="index.php?acao=emprestimos_listar" class="btn btn-secondary">Voltar</a>
  </form>
</div>
