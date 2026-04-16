<?php
session_start();
require_once 'Controllers/BaseController.php';
require_once 'Controllers/LivroController.php';
require_once 'Controllers/LoginController.php';
require_once 'Controllers/EmprestimoController.php';
require_once 'Controllers/DashboardController.php';

$acao = $_GET['acao'] ?? 'login';
if (!isset($_SESSION['usuario_id']) && !in_array($acao, ['login', 'logar', 'cadastro_usuario', 'salvar_usuario'])) {
    // Chuta de volta para o login
    header("Location: index.php?acao=login");
    exit;
}

$rotasProtegidas = [
     'dashboard'.'listar', 'criar', 'salvar', 'editar', 'atualizar', 'deletar',
    'emprestimos_listar', 'emprestimo_editar', 'emprestimo_atualizar', 'emprestimo_criar' , 'emprestimo_salvar'
];

if (in_array($acao, $rotasProtegidas) && empty($_SESSION['usuario_id'])) {
    header('Location: index.php?acao=login');
    exit;
}

switch ($acao) {
    case 'login':
        (new LoginController())->exibirFormulario();
        break;

    case 'logar':
        (new LoginController())->logar();
        break;

    case 'cadastro_usuario':
        (new LoginController())->exibirCadastro();
        break;

    case 'salvar_usuario':
        (new LoginController())->salvarNovoUsuario();
        break;

    case 'logout':
        (new LoginController())->logout();
        break;

    case 'listar':
        (new LivroController())->listar();
        break;

    case 'criar':
        (new LivroController())->criar();
        break;

    case 'salvar':
        (new LivroController())->salvar();
        break;

    case 'editar':
        (new LivroController())->editar();
        break;

    case 'atualizar':
        (new LivroController())->atualizar();
        break;

    case 'deletar':
        (new LivroController())->deletar();
        break;

    case 'emprestimos_listar':
        (new EmprestimoController())->listar();
        break;
 
        case 'emprestimo_criar':
        (new EmprestimoController())->criar();
        break;

    case 'emprestimo_salvar':
        (new EmprestimoController())->salvar();
        break;

    case 'emprestimo_editar':
        (new EmprestimoController())->editarForm();
        break;

    case 'emprestimo_atualizar':
        (new EmprestimoController())->atualizar();
        break;
case 'dashboard' :
    (new DashboardController())->index();
    break;
    default:
        if (!empty($_SESSION['usuario_id'])) {
            header('Location: index.php?acao=dashboard');
            exit;
        }
        (new LoginController())->exibirFormulario();
}