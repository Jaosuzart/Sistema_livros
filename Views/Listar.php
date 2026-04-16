<div class="d-flex justify-content-between align-items-center mb-4 mt-3">
    <h6>📚 Meus Livros</h2>
    <a href="index.php?acao=criar" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-circle"></i> Adicionar Novo
    </a>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <form action="index.php" method="GET" class="d-flex shadow-sm rounded">
            <input type="hidden" name="acao" value="listar">
            
            <input type="text" name="busca" class="form-control border-0" placeholder="Pesquisar livro por título..." value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>">
            
            <button class="btn btn-primary px-4 fw-bold" type="submit">
                <i class="bi bi-search"></i> Buscar
            </button>
            
            <?php if (!empty($_GET['busca'])): ?>
                <a href="index.php?acao=listar" class="btn btn-light border px-3" title="Limpar Pesquisa">
                    <i class="bi bi-x-lg text-danger"></i>
                </a>
            <?php endif; ?>
        </form>
    </div>
</div>

<?php if (empty($livros)): ?>
    <div class="alert alert-info shadow-sm border-0">Nenhum livro encontrado.</div>
<?php else: ?>
    <div class="row">
        <?php foreach ($livros as $livro): ?>
            
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    
                    <?php if (!empty($livro['capa'])): ?>
                        <img src="uploads/<?= htmlspecialchars($livro['capa']) ?>" class="card-img-top object-fit-cover" alt="Capa de <?= htmlspecialchars($livro['titulo']) ?>">
                    <?php else: ?>
                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 200px;">
                            <i class="bi bi-book fs-1"></i>
                        </div>
                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title fw-bold mb-1"><?= htmlspecialchars($livro['titulo'] ?? '') ?></h6>
                        
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <h6 class="card-subtitle text-muted mb-0"><?= htmlspecialchars($livro['autor'] ?? '') ?></h6>
                            <?php if (!empty($livro['ano'])): ?>
                                <span class="badge bg-secondary rounded-pill" style="font-size: 0.75rem;">
                                    <?= htmlspecialchars($livro['ano']) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <p class="card-text small flex-grow-1">
                            <?= htmlspecialchars($livro['descricao'] ?? '') ?>
                        </p>
                    </div>

                    <div class="card-footer bg-white border-top-0 pt-0 pb-3 text-center">
                        <a href="index.php?acao=editar&id=<?= $livro['id_livro'] ?>" class="btn btn-warning btn-sm text-dark fw-bold shadow-sm">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <a href="index.php?acao=deletar&id=<?= $livro['id_livro'] ?>" class="btn btn-danger btn-sm fw-bold shadow-sm">
                            <i class="bi bi-trash"></i> Excluir
                        </a>
                    </div>

                </div>
            </div>
            
        <?php endforeach; ?>
    </div>
<?php endif; ?>