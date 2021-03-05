<?php

class Evento extends Controller {

    protected $descricao = 'Evento';
    protected $categoriaLista = [
        'Notícia',
        'Vestibular',
        'Sua',
        'Concurso'
    ];

    public function __construct() {
        parent::__construct();
        $this->Model->paginacao = true;

        //Caso a ação tenha dado ok e tenha arquivo enviar o arquivo
        if ($this->ok && @$_FILES['ARQUIVO']['name'][0]) {
            $ARQ = $_FILES['ARQUIVO'];
            $chave = coalesce(@$this->dado[$this->ID_CHAVE], $this->Model->ultimoInsertId());

            foreach ($ARQ['name'] as $ind => $nome) {
                $extencao = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
                $arq_local = RAIZ . "/arquivos/{$chave}_" . $this->dado['IMAGEM'] . ".$extencao";
                if (!move_uploaded_file($ARQ['tmp_name'][$ind], $arq_local)) {
                    echo 'Rever o upload da imagem';
                }
            }
        }

        foreach ($_POST as $dado => $valor) {
            if (strpos(base64_decode($dado), 'XCLUIR-' . CHAVE) == 1) {
                $ARQ = str_replace('EXCLUIR-', '', base64_decode($dado));
                $ARQ_FILE = RAIZ . "/arquivos/" . $ARQ;
                IF (file_exists($ARQ_FILE)) {
                    unlink($ARQ_FILE);
                }
            }
        }
    }

    protected function executaPosAcao() {
        $this->dado['IMAGEM'] = @$this->Model->getDados()['IMAGEM'];
    }

    public function tamplateLista() {
        require __DIR__ . '/../Views/' . CLASSE . '/' . strtolower(CLASSE) . '-lista.php';
    }

    public function detalhe() {
        $this->dado = $this->Model->listar($this->where, true)[0];
        $this->requireForm('detalhe', 'Detalhe', false);
    }

}
