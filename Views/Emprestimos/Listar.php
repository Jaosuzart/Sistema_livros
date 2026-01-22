<?php
$baseUrl = '/Sistema_livros';
?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-3">
    <h2>📋 Controle de Empréstimos</h2>
</div>

<?php if (empty($emprestimos)): ?>
    <div class="alert alert-info">Nenhum empréstimo registrado.</div>
<?php else: ?>
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-hover align-middle bg-white">
            <thead class="table-light">
                <tr>
                    <th class="text-center">Livro</th>
                    <th>Título</th>
                    <th>Usuário</th>
                    <th>Data (Prazo/Real)</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emprestimos as $emp): ?>
                    <?php
                        // --- 1. INICIALIZAÇÃO DE VARIÁVEIS (Para evitar erros) ---
                        $urlCapa = null;
                        $statusClass = 'bg-secondary';
                        $dataExibida = '-';
                        $corData = '';
                        $legenda = '';
                        
                        // --- 2. LÓGICA DA IMAGEM ---
                        $capa = $emp['capa'] ?? null;
                        if ($capa) {
                            $urlCapa = "$baseUrl/uploads/" . rawurlencode($capa);
                        }

                        // --- 3. LÓGICA DO STATUS ---
                        // Garante que status nunca seja nulo
                        $status = $emp['status'] ?? 'indefinido';
                        
                        if ($status === 'devolvido') {
                            $statusClass = 'bg-success';
                        } else {
                            $statusClass = 'bg-warning text-dark';
                        }

                        // --- 4. LÓGICA DA DATA ---
                        $temDataReal = !empty($emp['data_devolucao']) && $emp['data_devolucao'] !== '0000-00-00';
                        $temPrazo    = !empty($emp['data_prevista_devolucao']) && $emp['data_prevista_devolucao'] !== '0000-00-00';

                        if ($status === 'devolvido' && $temDataReal) {
                            $dataExibida = date('d/m/Y', strtotime($emp['data_devolucao']));
                            $corData = 'text-success fw-bold'; 
                        } elseif ($temPrazo) {
                            $dataExibida = date('d/m/Y', strtotime($emp['data_prevista_devolucao']));

                            // Verifica atraso
                            if (date('Y-m-d') > $emp['data_prevista_devolucao']) {
                                $corData = 'text-danger fw-bold'; 
                                $legenda = '(Atrasado)';
                            } else {
                                $legenda = '(Prazo)';
                            }
                        }
                    ?>
                    
                    <tr>
                        <td class="text-center" style="width: 80px;">
                            <?php if ($urlCapa): ?>
                                <img src="<?= htmlspecialchars($urlCapa) ?>" style="width:50px;" class="img-thumbnail">
                            <?php else: ?>
                                <i class="bi bi-book fs-3 text-secondary"></i>
                            <?php endif; ?>
                        </td>

                        <td><?= htmlspecialchars($emp['titulo'] ?? '') ?></td>
                        
                        <td><?= htmlspecialchars($emp['email'] ?? '') ?></td>

                        <td class="<?= $corData ?>">
                            <?= $dataExibida ?>
                            <?php if (!empty($legenda)): ?>
                                <small class="d-block text-muted" style="font-size: 0.75rem;"><?= $legenda ?></small>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <span class="badge <?= $statusClass ?>">
                                <?= ucfirst(htmlspecialchars($status ?? '')) ?>
                            </span>
                        </td>

                        <td class="text-center">
                            <a href="index.php?acao=emprestimo_editar&id=<?= $emp['id_emprestimo'] ?>" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>