<?php

class Evento extends Controller {

    protected $descricao = 'Evento';
    protected $categoriaLista = [
        'Notícia',
        'Vestibular',
        'Seletivo',
        'Concurso'
    ];

    public function __construct() {
        parent::__construct();

        //Caso a ação tenha dado ok e tenha arquivo enviar o arquivo
        if ($this->ok && @$_FILES['IMAGEM']['name'][0]) {

            //Caso a ação tenha dado ok e tenha arquivo enviar o arquivo
            $ARQ = @$_FILES['IMAGEM'];
            $chave = coalesce(@$this->valorChave, $this->Model->ultimoInsertId());
            foreach ($ARQ['name'] as $ind => $nome) {
                $extencao = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
                $arqNome = "$chave.$extencao";
                $arq_local = RAIZ . "/arquivos/$arqNome";
                $this->ok = move_uploaded_file($ARQ['tmp_name'][$ind], $arq_local);
                if ($this->ok) {
                    $this->Model->valorChave = $chave;
                    $this->ok = $this->Model->alterar(['IMAGEM' => $arqNome]);
                    if (!$this->ok) {
                        echo 'Rever o upload da imagem';
                    }
                }
            }
        }

        //Caso a ação tenha dado ok e tenha arquivo enviar o arquivo
        if ($this->ok && @$_FILES['IMAGEM_INTERNA']['name'][0]) {

            //Caso a ação tenha dado ok e tenha arquivo enviar o arquivo
            $ARQ = @$_FILES['IMAGEM_INTERNA'];
            $chave = coalesce(@$this->valorChave, $this->Model->ultimoInsertId());
            foreach ($ARQ['name'] as $ind => $nome) {
                $extencao = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
                $arqNome = $chave . "_interno.$extencao";
                $arq_local = RAIZ . "/arquivos/$arqNome";
                move_uploaded_file($ARQ['tmp_name'][$ind], $arq_local);
            }
        }
    }

    //DADOS
    protected function validaSetDados() {

        //CATEGORIA 
        $this->dado['CATEGORIA'] = campo($_POST['CATEGORIA']);
        $this->campoValidacao('CATEGORIA');

        //TITULO
        $this->dado['TITULO'] = campo($_POST['TITULO']);
        $this->campoValidacao('TITULO', 150);

        //TEXTO 
        $this->dado['TEXTO'] = campo($_POST['TEXTO']);
        $this->campoValidacao('TEXTO', 8000);

        //TEXTO 
        $this->dado['IMAGEM_APARECER_DETALHE'] = campo($_POST['IMAGEM_APARECER_DETALHE']);
        $this->campoValidacao('IMAGEM_APARECER_DETALHE', 1);

        //NOME unico
        if (!$this->erro) {
            if ($this->Model->descricaoExistente(['TITULO' => $this->dado['TITULO']])) {
                $this->erro['Título'] = 'Já cadastrado';
            }
        }

        return $this->dadosValidacao();
    }

    public function templateLista() {
        require __DIR__ . '/../Views/' . CLASSE . '/' . strtolower(CLASSE) . '-lista.php';
    }

    public function detalhe() {
        $this->mostrarDescricaoAcao = false;
        $this->Model->addWhere($this->ID_CHAVE, CHAVE);
        $this->dado = $this->Model->listar()[0];
        $this->action = 'Evento/detalhe/' . CHAVE;
        $this->requireForm('detalhe', 'Detalhe', false);
    }

}
