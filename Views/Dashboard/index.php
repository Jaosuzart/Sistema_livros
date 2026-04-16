<div class="d-flex justify-content-between align-items-center mb-4 mt-3">
    <h2 class="fw-bold"><i class="bi bi-speedometer2 text-primary"></i> Painel de Controle</h2>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow h-100 bg-primary text-white rounded-4">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                <i class="bi bi-book fs-1 mb-2"></i>
                <h3 class="display-5 fw-bold mb-0"><?= $totalLivros ?></h3>
                <span class="fs-5">Livros Cadastrados</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow h-100 bg-success text-white rounded-4">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                <i class="bi bi-people fs-1 mb-2"></i>
                <h3 class="display-5 fw-bold mb-0"><?= $totalUsuarios ?></h3>
                <span class="fs-5">Leitores</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow h-100 bg-warning text-dark rounded-4">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                <i class="bi bi-bookmark-check fs-1 mb-2"></i>
                <h3 class="display-5 fw-bold mb-0"><?= $totalEmprestados ?></h3>
                <span class="fs-5">Emprestados</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow h-100 bg-danger text-white rounded-4">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                <i class="bi bi-exclamation-triangle fs-1 mb-2"></i>
                <h3 class="display-5 fw-bold mb-0"><?= $totalAtrasados ?></h3>
                <span class="fs-5 text-center">Atrasados</span>
            </div>
        </div>
    </div>
    <div class="mt-2 mb-4">
    <h3 class="fw-bold text-danger"><i class="bi bi-cash-coin"></i> Multas Pendentes por Usuário</h3>
</div>

<?php if (empty($multasPendentes)): ?>
    <div class="alert alert-success shadow-sm border-0 d-flex align-items-center mb-5">
        <i class="bi bi-emoji-smile fs-3 me-3 text-success"></i>
        <div>
            <strong>Ótima notícia!</strong><br> 
            Nenhum usuário possui multas atrasadas no momento. Todos estão em dia!
        </div>
    </div>
<?php else: ?>
    <div class="table-responsive shadow-sm rounded mb-5">
        <table class="table table-hover align-middle bg-white mb-0">
            <thead class="table-light">
                <tr>
                    <th>Usuário</th>
                    <th>Email</th>
                    <th>Livro Atrasado</th>
                    <th class="text-center">Atraso</th>
                    <th class="text-end pe-4">Valor da Multa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($multasAtrasadas as $multa): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($multa['nome'] ?? 'Sem Nome') ?></td>
                        <td><?= htmlspecialchars($multa['email']) ?></td>
                        <td class="fst-italic"><?= htmlspecialchars($multa['titulo']) ?></td>
                        <td class="text-center text-danger fw-bold">
                            <?= $multa['dias_atraso'] ?> dias
                        </td>
                        <td class="text-danger text-end fw-bold pe-4">
                            R$ <?= number_format($multa['valor_multa'], 2, ',', '.') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
</div>