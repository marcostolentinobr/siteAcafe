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
        $ARQ = @$_FILES['IMAGEM'];
        if ($this->ok && $ARQ['name'][0]) {
            $chave = coalesce(@$this->dado[$this->ID_CHAVE], $this->Model->ultimoInsertId());

            foreach ($ARQ['name'] as $ind => $nome) {
                $extencao = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
                $arqNome = "$chave.$extencao";
                $arq_local = RAIZ . "/arquivos/$arqNome";
                $this->ok = move_uploaded_file($ARQ['tmp_name'][$ind], $arq_local);
                if ($this->ok) {
                    $this->ok = $this->Model->alterar(['ID_EVENTO' => $chave], ['IMAGEM' => $arqNome]);
                }
                if (!$this->ok) {
                    echo 'Rever o upload da imagem';
                }
            }
        }
    }

    protected function executaPosAcao() {
        $this->dado['IMAGEM'] = coalesce(@$this->dado['IMAGEM'], @$this->Model->getDados()['IMAGEM']);
    }

    public function tamplateLista() {
        require __DIR__ . '/../Views/' . CLASSE . '/' . strtolower(CLASSE) . '-lista.php';
    }

    public function detalhe() {
        $this->mostrarDescricaoAcao = false;
        $this->dado = $this->Model->listar([$this->ID_CHAVE => CHAVE], true)[0];
        $this->requireForm('detalhe', 'Detalhe', false);
    }

}
