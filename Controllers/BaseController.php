<?php
class BaseController {

    public function view(string $nomeArquivo, array $dados = []): void {
        extract($dados);

        // Normaliza barras
        $nomeArquivo = str_replace('\\', '/', $nomeArquivo);

        $baseViews = realpath(__DIR__ . '/../Views');
        if (!$baseViews) {
            die("Pasta Views não encontrada.");
        }

        $conteudoDaPagina = $baseViews . '/' . $nomeArquivo . '.php';
        $layout = $baseViews . '/Layout.php';

        if (!file_exists($layout)) {
            die("Layout não encontrado em: " . $layout);
        }

        if (!file_exists($conteudoDaPagina)) {
            die("View não encontrada em: " . $conteudoDaPagina);
        }

        require $layout;
    }
}
