<div class="row justify-content-center mt-4">
  <div class="col-md-8">
    <div class="card shadow-sm">
      <div class="card-body">

        <h3 class="mb-3">Editar Livro</h3>

        <form action="index.php?acao=atualizar" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id_livro" value="<?= (int)($livro['id_livro'] ?? 0) ?>">

          <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required value="<?= htmlspecialchars($livro['titulo'] ?? '') ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Autor</label>
            <input type="text" name="autor" class="form-control" required value="<?= htmlspecialchars($livro['autor'] ?? '') ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control"><?= htmlspecialchars($livro['descricao'] ?? '') ?></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Trocar capa (opcional)</label>
            <input type="file" name="imagem" class="form-control" accept="image/*">
          </div>
          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="index.php?acao=listar" class="btn btn-secondary">Voltar</a>
        </form>

      </div>
    </div>
  </div>
</div>
