<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de gerenciamento de livros e empréstimos, desenvolvido em PHP com arquitetura MVC. Permite cadastro de livros, controle de empréstimos e gestão de usuários.">
    <title><?= defined('APP_NAME') ? APP_NAME : 'Sistema de Livros' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php?acao=listar">
                <i class="bi bi-journal-bookmark-fill"></i> Biblioteca
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                  <li class="nav-item">
                <a  class="nav-link text-white fw-bold" href="index.php?acao=dashboard">Painel</a>
             </li>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php?acao=listar">Livros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php?acao=criar">Novo Livro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php?acao=emprestimos_listar">Empréstimos</a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center mt-2 mt-lg-0">
                        <span class="text-light me-3">
                            <i class="bi bi-person-circle"></i> Olá, <?= htmlspecialchars($_SESSION['usuario_email'] ?? 'Usuário') ?>
                        </span>
                        <a href="index.php?acao=logout" class="btn btn-danger btn-sm fw-bold shadow-sm">
                            <i class="bi bi-box-arrow-right"></i> Sair
                        </a>
                    </div>
                <?php endif; ?>
                <?php endif;?>
            </div>
        </div>
    </nav>

    <main class="container flex-grow-1">
        <?php 
        // O BaseController envia a variável $conteudoDaPagina para cá!
        if (isset($conteudoDaPagina) && file_exists($conteudoDaPagina)) {
            require $conteudoDaPagina;
        } 
        ?>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-auto w-100 small">
        &copy; <?= date('Y') ?> Sistema de Livros MVC. Todos os direitos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>