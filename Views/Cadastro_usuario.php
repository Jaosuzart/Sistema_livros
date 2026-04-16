<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-sm border-0" style="width: 100%; max-width: 500px;">
        <div class="card-body p-4 p-sm-5">
            <div class="text-center mb-4">
                <i class="bi bi-person-plus-fill text-success mb-2" style="font-size: 3rem;"></i>
                <h3 class="fw-bold">Criar Conta</h3>
            </div>

            <?php if (!empty($erro)): ?>
                <div class="alert alert-danger text-center shadow-sm py-2"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form action="index.php?acao=salvar_usuario" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nome Completo</label>
                    <input type="text" name="nome" class="form-control" placeholder="João Marcelo" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">CPF <small class="text-muted fw-normal">(Opcional)</small></label>
                        <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00">
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <label class="form-label fw-bold">E-mail</label>
                        <input type="email" name="email" class="form-control" placeholder="seu@email.com" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Senha</label>
                    <input type="password" name="senha" class="form-control" placeholder="Crie uma senha forte" required>
                </div>

                <button type="submit" class="btn btn-success w-100 fw-bold py-2 mb-3 shadow-sm">
                    Cadastrar <i class="bi bi-check-circle"></i>
                </button>

                <div class="text-center mt-3">
                    <span class="text-muted small">Já possui conta?</span><br>
                    <a href="index.php?acao=login" class="text-decoration-none fw-bold">Faça Login aqui</a>
                </div>
            </form>
        </div>
    </div>
</div>