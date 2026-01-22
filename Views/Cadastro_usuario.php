<div class="row justify-content-center mt-5">
  <div class="col-md-5">
    <div class="card shadow">
      <div class="card-header bg-success text-white">
        <h4 class="mb-0">Criar Nova Conta</h4>
      </div>

      <div class="card-body p-4">
        <?php if(isset($erro)): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $erro ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <form action="index.php?acao=salvar_usuario" method="POST">
          <div class="mb-3">
            <label class="form-label">Nome Completo</label>
            <input type="text" name="nome" class="form-control" required placeholder="Seu nome">
          </div>

          <div class="mb-3">
            <label class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00">
          </div>

          <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" required placeholder="seu@email.com">
          </div>

          <div class="mb-3">
            <label class="form-label">Crie uma Senha</label>
            <input type="password" name="senha" class="form-control" required placeholder="******">
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="index.php?acao=login" class="btn btn-outline-secondary">Voltar para Login</a>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
