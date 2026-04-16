<div class="container mt-4" style="max-width: 800px;">
    <div class="card-shadow-sm border-0">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h5 class="fw-bold mb-0"><i class="bi bi-plus-circle text-primary"></i> Novo livro</h1>
    </div>
    <div class="card-body">
        <form action="index.php?acao=salvar" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label fw-bold">Título</label>
                <input type="text" name="titulo" class="form-control" placeholder="Digite o título do livro" required>
            </div>
            <div class="row mb-3">
                <div class="col-md-8">
                    <label class="form-label fw-bold">Autor</label>
                    <input type="text" name="autor" class="form-control" placeholder="Nome do autor" required>
                </div>
                 <div class="col-md-4 mt-3 mt-md-0">
                    <label class="form-label fw-bold">Ano</label>
                    <input type="number" name="ano" class="form-control" placeholder="Ex:2023" required>
                </div>
            </div>
            <div class="mb-3">
                    <label class="form-label fw-bold">Descrição</label>
                    <textarea name="descricao" class="form-control" rows="4" placeholder="Sinopse ou detalhes do livro..."></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Capa (opcional)</label>
                    <input type="file" name="imagem" class="form-control" accept="image/*">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4 fw-bold">
                        <i class="bi bi-check-lg"></i> Salvar Livro
                    </button>
                    <a href="index.php?acao=listar" class="btn btn-secondary px-4 fw-bold">Cancelar</a>
                </div>
              <div class="mb-4">
        </form>
    </div>
    </div>
</div>