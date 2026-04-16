<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-sm border-0" style="width: 100%; max-width: 400px;">
        <div class="card-body p-4 p-sm-5">
            <div class="text-center mb-4">
                <i class="bi bi-person-circle text-primary mb-2" style="font-size: 3rem;"></i>
                <h7 class="fw-bold">Acesso ao Sistema</h7>
            </div>

            <?php if (isset($erro)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert"><?= ($erro) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['sucesso'])): ?>
                <div class="alert alert-success text-center shadow-sm py-2">Cadastro realizado! Faça seu login.</div>
            <?php endif; ?>

            <form action="index.php?acao=logar" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="seu@email.com" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Senha</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                        <input type="password" name="senha" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 mb-3 shadow-sm">
                    Entrar <i class="bi bi-box-arrow-in-right"></i>
                </button>

                <div class="text-center mt-3">
                    <span class="text-muted small">Ainda não tem conta?</span><br>
                    <a href="index.php?acao=cadastro_usuario" class="text-decoration-none fw-bold">Criar uma conta</a>
                </div>
            </form>
        </div>
    </div>
</div>