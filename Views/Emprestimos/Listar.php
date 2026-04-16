<?php $baseUrl = '/sistema_livros_1'; ?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 mt-3">
    <h2 class="fw-bold mb-3 mb-md-0"><i class="bi bi-clipboard-check text-success"></i> Controle de Empréstimos</h2>
    <a href="index.php?acao=emprestimo_criar" class="btn btn-primary fw-bold shadow-sm px-4">
        <i class="bi bi-plus-circle"></i> Novo Empréstimo
    </a>
</div>

<?php if (empty($emprestimos)): ?>
    <div class="alert alert-info d-flex align-items-center shadow-sm border-0 mt-4 py-4" role="alert">
        <i class="bi bi-info-circle-fill fs-2 me-4 text-info"></i>
        <div>
            <h2 class="alert-heading fw-bold mb-1">Nenhum empréstimo registrado!</h2>
            <p class="mb-0 text-muted">Ainda não há livros emprestados no momento. Clique no botão azul <strong>"Novo Empréstimo"</strong> acima para registrar o primeiro.</p>
        </div>
    </div>

<?php else: ?>
    <div class="table-responsive shadow-sm rounded mb-5 pb-4">
        <table class="table table-hover align-middle bg-white mb-0">
            <thead class="table-light">
                <tr>
                    <th class="text-center">Livro</th>
                    <th>Título</th>
                    <th>Usuário</th>
                    <th>Data (Prazo/Real)</th>
                    <th class="text-center">Status</th>
                    <th class="text-center text-nowrap" style="width: 150px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emprestimos as $emp): ?>
                    <?php
                    // Lógica da Capa
                    $urlCapa = null;
                    if (!empty($emp['capa'])) {
                        $urlCapa = "$baseUrl/uploads/" . rawurlencode($emp['capa']);
                    }

                    // Lógica de Status e Datas
                    $status = $emp['status'] ?? 'indefinido';
                    $textoBadge = ucfirst(htmlspecialchars($status));
                    $statusClass = 'bg-secondary';
                    $corData = '';
                    $legenda = '';
                    $dataExibida = '-';

                    $temDataReal = !empty($emp['data_devolucao']) && $emp['data_devolucao'] !== '0000-00-00';
                    $temPrazo    = !empty($emp['data_prevista_devolucao']) && $emp['data_prevista_devolucao'] !== '0000-00-00';
                    $hoje = date('Y-m-d');

                    if ($status === 'devolvido') {
                        $statusClass = 'bg-success';
                        if ($temDataReal) {
                            $dataExibida = date('d/m/Y', strtotime($emp['data_devolucao']));
                            $corData = 'text-success fw-bold';
                        }
                    } else {
                        if ($temPrazo) {
                            $dataExibida = date('d/m/Y', strtotime($emp['data_prevista_devolucao']));

                            if ($hoje > $emp['data_prevista_devolucao']) {
                                $statusClass = 'bg-danger';
                                $textoBadge = 'Atrasado';
                                $corData = 'text-danger fw-bold';

                                $dias_atraso = floor((strtotime($hoje) - strtotime($emp['data_prevista_devolucao'])) / (60 * 60 * 24));
                                $valor_multa = $dias_atraso * 2.00; // R$ 2,00 por dia

                                $legenda = '(Atrasado: ' . $dias_atraso . ' dias) <br> <span class="text-danger fw-bold">Multa: R$ ' . number_format($valor_multa, 2, ',', '.') . '</span>';
                            } else {
                                $statusClass = 'bg-warning text-dark';
                                $legenda = '(No Prazo)';
                            }
                            // ---------------------------------------
                        }
                    }
                    ?>

                    <tr>
                        <td class="text-center" style="width: 90px;">
                            <?php if ($urlCapa): ?>
                                <img src="<?= htmlspecialchars($urlCapa) ?>" style="width:65px; height: 90px;" class="object-fit-cover rounded border shadow-sm my-2">
                            <?php else: ?>
                                <div class="bg-light rounded border d-flex align-items-center justify-content-center mx-auto my-2 shadow-sm" style="width:65px; height:90px;">
                                    <i class="bi bi-book fs-4 text-secondary"></i>
                                </div>
                            <?php endif; ?>
                        </td>

                        <td class="fw-bold text-truncate" style="max-width: 200px;" title="<?= htmlspecialchars($emp['titulo'] ?? '') ?>">
                            <?= htmlspecialchars($emp['titulo'] ?? '') ?>
                            <br>
                            <small class="text-muted fw-normal" style="font-size: 0.75rem;">
                                Estoque: <?= $emp['quantidade'] ?? '?' ?> <?= ($emp['quantidade'] == 1) ? 'unidade' : 'unidades' ?>
                            </small>
                        </td>

                        <td><?= htmlspecialchars($emp['email'] ?? '') ?></td>

                        <td class="<?= $corData ?>">
                            <?= $dataExibida ?>
                            <?php if (!empty($legenda)): ?>
                                <small class="d-block text-muted" style="font-size: 0.75rem;"><?= $legenda ?></small>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <span class="badge <?= $statusClass ?> px-3 py-2 rounded-pill">
                                <?= htmlspecialchars($textoBadge) ?>
                            </span>
                        </td>

                        <td class="text-center text-nowrap">
                            <a href="index.php?acao=emprestimo_editar&id=<?= $emp['id_emprestimo'] ?>" class="btn btn-sm btn-primary fw-bold shadow-sm">
                                <i class="bi bi-check2-square"></i> Dar Baixa / Editar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<div class="mb-5 pb-4"></div>