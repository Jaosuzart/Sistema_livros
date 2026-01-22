<div class="row justify-content-center mt-4">
  <div class="col-md-8">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="mb-3">Novo Livro</h3>

        <form action="index.php?acao=salvar" method="POST" enctype="multipart/form-data">

          <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Autor</label>
            <input type="text" name="autor" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Capa (opcional)</label>
            <input type="file" name="imagem" class="form-control" accept="image/*">
          </div>

          <div class="mb-3">
            <label class="form-label">Link</label>
            <input type="url" name="link" class="form-control">
          </div>

          <button type="submit" class="btn btn-success w-100">Salvar Livro</button>
          <a href="index.php?acao=listar" class="btn btn-secondary w-100 mt-2">Cancelar</a>

        </form>
      </div>
    </div>
  </div>
</div>
