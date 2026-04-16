<?php
require_once __DIR__ .'/BaseController.php';
require_once __DIR__ .'/../Config/Database1.php';
require_once __DIR__ .'/../Models/Livro.php';
require_once __DIR__ .'/../Models/Usuario.php';
require_once __DIR__ .'/../Models/Emprestimo.php';
class DashboardController extends BaseController{
    public function index(){
        $db = (new Database())->conectar();
        $livroModel = new Livro($db);
        $usuarioModel = new Usuario($db);
        $emprestimoModel = new Emprestimo($db);
        // Puxa as contagens do banco de dados
        $totalLivros = $livroModel->contarTotal();
            $totalUsuarios = $usuarioModel->contarTotal();
        $totalEmprestados = $emprestimoModel->contarPorStatus('emprestado');
        $totalAtrasados = $emprestimoModel->contarPorStatus('atrasado');
        $multasAtrasadas = $emprestimoModel->lerMultasPendentes();
        $this->view('Dashboard/Index', [
            'totalLivros' => $totalLivros,
            'totalUsuarios' => $totalUsuarios,
            'totalEmprestados' => $totalEmprestados,
            'totalAtrasados' => $totalAtrasados,
            'multasAtrasadas' => $multasAtrasadas
        ]);

    }
}
