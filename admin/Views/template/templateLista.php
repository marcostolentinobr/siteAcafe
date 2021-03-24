<?

foreach ($this->dadoLista as $dado) {
    require __DIR__ . '/../' . CLASSE . '/' . strtolower(CLASSE) . '-lista.php';
    require __DIR__ . '/templateBotoes.php';
    echo '<hr>';
}

if ($this->Model->paginacao) {
    require_once 'templatePaginacao.php';
}