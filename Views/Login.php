<div class="row justify-content-center mt-5">
  <div class="col-md-4">
    <div class="card shadow">
      <div class="card-body p-4">
        <h3 class="text-center mb-4">Login</h3>

        <?php if(isset($_GET['sucesso'])): ?>
          <div class="alert alert-success alert-dismissible fade show">
            Cadastro realizado! Faça login abaixo.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php endif; ?>

        <?php if(isset($erro)): ?>
          <div class="alert alert-danger alert-dismissible fade show">
            <?= $erro ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php endif; ?>

        <form action="index.php?acao=autenticar" method="POST">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>

          <div class="text-center">
            <a href="index.php?acao=registrar">Não tem conta? Cadastre-se aqui</a>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
