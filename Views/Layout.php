<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ajuste automático da URL base
$baseUrl = '/Sistema_livros'; 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Livros MVC</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php?acao=listar">
        <i class="bi bi-journal-bookmark-fill"></i> Biblioteca
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center gap-3">

        <?php if (!empty($_SESSION['usuario_id'])): ?>
            <li class="nav-item"><a class="nav-link" href="index.php?acao=listar">Livros</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?acao=criar">Novo Livro</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?acao=emprestimos_listar">Empréstimos</a></li>
            
            <li class="nav-item d-flex align-items-center bg-white bg-opacity-10 rounded px-3 py-1">
                <i class="bi bi-person-circle text-white me-2"></i>
                <div class="d-flex flex-column text-white" style="line-height: 1.2;">
                    <span style="font-size: 0.85rem;">Olá, Usuário</span>
                    <span style="font-size: 0.75rem; opacity: 0.9;">
                        <?= htmlspecialchars($_SESSION['usuario_email'] ?? 'Sem email') ?>
                    </span>
                </div>
            </li>

            <li class="nav-item">
                <a class="btn btn-danger btn-sm" href="index.php?acao=logout">Sair</a>
            </li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="index.php?acao=login">Login</a></li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>

<main class="container flex-grow-1 py-4">
  <?php 
    if (file_exists($conteudoDaPagina)) {
        require $conteudoDaPagina; 
    } else {
        echo "<div class='alert alert-danger'>Erro: View não encontrada.</div>";
    }
  ?>
</main>

<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
      <small class="d-block mb-1">&copy; 2026 Sistema de Livros MVC. Todos os direitos reservados.</small>
      <small class="text-secondary">Desenvolvido para fins educacionais.</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>