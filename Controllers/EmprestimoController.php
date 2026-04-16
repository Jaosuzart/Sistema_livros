<?php
require_once __DIR__ . '/../Controllers/BaseController.php';
require_once __DIR__ . '/../Config/Database1.php';
require_once __DIR__ . '/../Models/Emprestimo.php';
require_once __DIR__ . '/../Models/Livro.php';
require_once __DIR__ . '/../Models/Usuario.php';


class EmprestimoController extends BaseController {

    public function listar() {
        $db = (new Database())->conectar();
        $model = new Emprestimo($db);
        $id_usuario_logado = $_SESSION['usuario_id'] ?? 0;
        $emprestimos = $model->lerPorUsuário($id_usuario_logado);
        $this->view('Emprestimos/Listar', ['emprestimos' => $emprestimos]);
    }

    public function editarForm() {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?acao=emprestimos_listar");
            exit;
        }

        $db = (new Database())->conectar();

        $empModel = new Emprestimo($db);
        $livroModel = new Livro($db);

        $emp = $empModel->buscarPorId($id);
        if (!$emp) {
            header("Location: index.php?acao=emprestimos_listar");
            exit;
        }

        $livros = $livroModel->lerTodos();
        $this->view('Emprestimos/Editar', ['emp' => $emp, 'livros' => $livros]);
    }

    public function atualizar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?acao=emprestimos_listar");
            exit;
        }

        $id = (int)($_POST['id_emprestimo'] ?? 0);
        $id_livro = (int)($_POST['id_livro'] ?? 0);
        $status = $_POST['status'] ?? 'emprestado';
        $data_devolucao = $_POST['data_devolucao'] ?? null;

        $forma_pagamento = $_POST['forma_pagamento'] ?? 'nenhuma';
        if ($id <= 0 || $id_livro <= 0) {
            header("Location: index.php?acao=emprestimos_listar");
            exit;
        }

        $db = (new Database())->conectar();
        (new Emprestimo($db))->atualizar($id, $id_livro, $status, $data_devolucao, $forma_pagamento);

        header("Location: index.php?acao=emprestimos_listar");
        exit;
    }
    public function criar(){
        $db = (new Database ())->conectar();
        require_once __DIR__ . '/../Models/Livro.php';
        require_once __DIR__ . '/../Models/Usuario.php';
        $livroModel = new Livro($db);
        $usuarioModel = new Usuario($db);
        $this->view('Emprestimos/Form_cadastro', [
            'livros' => $livroModel->lerTodos(),
            'usuarios' => $usuarioModel->lerTodos()  
        ]);
    }
    public function salvar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id_livro = $_POST['id_livro'] ?? '';
            $id_usuario = $_POST['id_usuario'] ?? '';
            $data_prevista = $_POST['data_prevista_devolucao'] ?? '';
            if(!empty($id_livro) && !empty($id_usuario) && !empty($data_prevista)){
                $db = (new Database())->conectar();
                $emprestimoModel = new Emprestimo($db);
                if( $emprestimoModel->verificarBloqueioUsuario($id_usuario)){
                header("Location: index.php?acao=emprestimos_criar&erro=bloqueado");
                 exit;
                }
                $emprestimoModel->cadastrar($id_livro, $id_usuario, $data_prevista);
            }
            header("Location: index.php?acao=emprestimos_listar");
            exit;

        }
    }
}
