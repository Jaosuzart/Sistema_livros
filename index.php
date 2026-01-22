<?php
session_start();

require_once 'Controllers/BaseController.php';
require_once 'Controllers/LivroController.php';
require_once 'Controllers/LoginController.php';
require_once 'Controllers/EmprestimoController.php';

$acao = $_GET['acao'] ?? 'login';

$rotasProtegidas = [
    'listar', 'criar', 'salvar', 'editar', 'atualizar', 'deletar',
    'emprestimos_listar', 'emprestimo_editar', 'emprestimo_atualizar'
];

if (in_array($acao, $rotasProtegidas) && empty($_SESSION['usuario_id'])) {
    header('Location: index.php?acao=login');
    exit;
}

switch ($acao) {

    case 'login':
        (new LoginController())->exibirFormulario();
        break;

    case 'autenticar':
        (new LoginController())->logar();
        break;

    case 'registrar':
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

    case 'emprestimo_editar':
        (new EmprestimoController())->editarForm();
        break;

    case 'emprestimo_atualizar':
        (new EmprestimoController())->atualizar();
        break;

    default:
        if (!empty($_SESSION['usuario_id'])) {
            header('Location: index.php?acao=listar');
            exit;
        }
        (new LoginController())->exibirFormulario();
}