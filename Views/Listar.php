<?php
// Ajuste a URL base se necessário
$baseUrl = '/Sistema_livros'; 
?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-3">
    <h2>📚 Meus Livros</h2>
    <a href="index.php?acao=criar" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Adicionar Novo
    </a>
</div>

<?php if (empty($livros)): ?>
    <div class="alert alert-info">Nenhum livro cadastrado.</div>
<?php else: ?>
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-hover align-middle bg-white">
            <thead class="table-light">
                <tr>
                    <th class="text-center" style="width: 100px;">Capa</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th style="width: 100px;">Ano</th>
                    <th class="text-center" style="width: 140px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livros as $livro): ?>
                    <?php 
                        $id = (int)($livro['id_livro'] ?? 0);
                        $capaNome = $livro['capa'] ?? null;
                        
                        // CORREÇÃO 1: Apontar para a pasta /uploads (na raiz)
                        // CORREÇÃO 2: rawurlencode resolve problemas de espaço no nome do arquivo
                        $urlCapa = null;
                        if ($capaNome) {
                            $urlCapa = "$baseUrl/uploads/" . rawurlencode($capaNome);
                        }

                        // Verificação física do arquivo (Opcional, mas bom para debug)
                        // __DIR__ é a pasta Views. Voltamos uma (..) para a raiz e entramos em uploads
                        $caminhoFisico = __DIR__ . '/../uploads/' . $capaNome;
                    ?>
                    <tr>
                        <td class="text-center">
                            <?php if ($capaNome && file_exists($caminhoFisico)): ?>
                                <img src="<?= $urlCapa ?>" 
                                     alt="Capa" 
                                     style="width:60px; height:auto; object-fit: cover;" 
                                     class="img-thumbnail">
                            <?php else: ?>
                                <i class="bi bi-book fs-2 text-secondary"></i>
                            <?php endif; ?>
                        </td>

                        <td class="fw-bold"><?= htmlspecialchars($livro['titulo'] ?? '') ?></td>
                        <td><?= htmlspecialchars($livro['autor'] ?? '') ?></td>
                        <td><?= htmlspecialchars($livro['ano'] ?? '-') ?></td>

                        <td class="text-center">
                            <a href="index.php?acao=editar&id=<?= $id ?>" class="btn btn-sm btn-warning" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <a href="index.php?acao=deletar&id=<?= $id ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Tem certeza que deseja deletar este livro?');" title="Deletar">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>