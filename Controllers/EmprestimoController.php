<?php
require_once __DIR__ . '/../Controllers/BaseController.php';
require_once __DIR__ . '/../Config/Database1.php';
require_once __DIR__ . '/../Models/Emprestimo.php';
require_once __DIR__ . '/../Models/Livro.php';

class EmprestimoController extends BaseController {

    public function listar() {
        $db = (new Database())->conectar();
        $model = new Emprestimo($db);

        $emprestimos = $model->listarComUsuarioELivro();
        $this->view('emprestimos/Listar', ['emprestimos' => $emprestimos]);
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

        $livros = $livroModel->lerTodos()->fetchAll();
        $this->view('emprestimos/Editar', ['emp' => $emp, 'livros' => $livros]);
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

        if ($id <= 0 || $id_livro <= 0) {
            header("Location: index.php?acao=emprestimos_listar");
            exit;
        }

        $db = (new Database())->conectar();
        (new Emprestimo($db))->atualizar($id, $id_livro, $status, $data_devolucao);

        header("Location: index.php?acao=emprestimos_listar");
        exit;
    }
}
