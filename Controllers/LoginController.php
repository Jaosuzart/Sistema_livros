<?php
require_once __DIR__ . '/../Config/Database1.php';
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/BaseController.php';

class LoginController extends BaseController {

    public function exibirFormulario() {
        $this->view('Login');
    }

    public function logar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $db = (new Database())->conectar();
            $usuarioModel = new Usuario($db);
            $usuario = $usuarioModel->buscarPorEmail($email);

            if ($usuario && isset($usuario['senha']) && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_email'] = $usuario['email'];
                header("Location: index.php?acao=listar");
                exit;
            }

            $this->view('Login', ['erro' => 'Email ou senha incorretos!']);
        }
    }

    public function exibirCadastro() {
        $this->view('Cadastro_usuario');
    }

    public function salvarNovoUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $cpf = !empty($_POST['cpf']) ? $_POST['cpf'] : null;
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $db = (new Database())->conectar();
            $usuarioModel = new Usuario($db);

            if ($usuarioModel->buscarPorEmail($email)) {
                $this->view('Cadastro_usuario', ['erro' => 'Já existe uma conta com esse e-mail.']);
                return;
            }

            $usuarioModel->cadastrar($nome, $cpf, $email, $senha);
            header("Location: index.php?acao=login&sucesso=1");
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?acao=login");
        exit;
    }
}
