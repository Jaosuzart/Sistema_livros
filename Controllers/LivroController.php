<?php
require_once __DIR__ . '/../Controllers/BaseController.php';
require_once __DIR__ . '/../Config/Database1.php';
require_once __DIR__ . '/../Models/Livro.php';

class LivroController extends BaseController
{
    public function listar()
    {
        $db = (new Database())->conectar();
        $livroModel = new Livro($db);

        $stmt = $livroModel->lerTodos();
        $dadosLivros = $stmt->fetchAll();

        $this->view('Listar', ['livros' => $dadosLivros]);
    }

    public function criar()
    {
        $this->view('Form_cadastro');
    }

    public function salvar()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: index.php?acao=listar");
        exit;
    }

    $db = (new Database())->conectar();
    $livroModel = new Livro($db);

    $capa = null;

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $nomeArquivo = uniqid() . '-' . basename($_FILES['imagem']['name']);
        $destinoFisico = __DIR__ . '/../uploads/' . $nomeArquivo;

        move_uploaded_file($_FILES['imagem']['tmp_name'], $destinoFisico);
        $capa = $nomeArquivo; // ✅ AGORA SALVA
    }

    $titulo = $_POST['titulo'] ?? '';
    $autor  = $_POST['autor'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $ano = !empty($_POST['ano']) ? (int)$_POST['ano'] : null;
    $livroModel->criar($titulo, $autor, $descricao, $capa, null, $ano);
    $livroModel->criar($titulo, $autor, $descricao, $capa, null);

    header("Location: index.php?acao=listar");
    exit;
}


    public function editar()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?acao=listar");
            exit;
        }

        $db = (new Database())->conectar();
        $livroModel = new Livro($db);
        $livro = $livroModel->listarPorId($id);

        $this->view('Editar', ['livro' => $livro]);
    }

    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?acao=listar");
            exit;
        }

        $db = (new Database())->conectar();
        $livroModel = new Livro($db);

        $id = (int)($_POST['id_livro'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?acao=listar");
            exit;
        }

        $titulo = $_POST['titulo'] ?? '';
        $autor  = $_POST['autor'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $ano = !empty($_POST['ano']) ? (int)$_POST['ano'] : null;

        // null = manter a capa atual
        $capa = null;

        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
            $nomeLimpo = preg_replace('/[^a-zA-Z0-9._-]/', '', basename($_FILES['imagem']['name']));
            $nomeArquivo = uniqid() . '-' . $nomeLimpo;

            $destinoFisico = $uploadDir . $nomeArquivo;

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destinoFisico)) {
                $capa = $nomeArquivo;
            }
        }

        $livroModel->atualizar($id, $titulo, $autor, $descricao, $capa, null, $ano);

        header("Location: index.php?acao=listar");
        exit;
    }

    public function deletar()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?acao=listar");
            exit;
        }

        $db = (new Database())->conectar();
        $livroModel = new Livro($db);

        $livroModel->deletar($id);

        header("Location: index.php?acao=listar");
        exit;
    }
}
