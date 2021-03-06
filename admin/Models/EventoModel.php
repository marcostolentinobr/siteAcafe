<?php

class EventoModel extends Model {

    public $tabela = 'EVENTO';
    public $chave = 'ID_EVENTO';
    public $buscarCampos = ['TITULO'];

    public function __construct($pdo = '', $paginacao = true) {
        parent::__construct($pdo, $paginacao);
        $this->addOrder('DATA_PUBLICACAO DESC');
    }

    //DADOS
    protected function dado($dado, $metodo = __METHOD__) {

        //CATEGORIA 
        $this->dado['CATEGORIA'] = campo($dado['CATEGORIA']);
        $this->campoValidacao('CATEGORIA');

        //TITULO
        $this->dado['TITULO'] = campo($dado['TITULO']);
        $this->campoValidacao('TITULO', 150);

        //TEXTO 
        $this->dado['TEXTO'] = campo($dado['TEXTO']);
        $this->campoValidacao('TEXTO', 8000);

        //ID_USUARIO 
        $this->dado['ID_USUARIO'] = getSession('ID_USUARIO');
        $this->campoValidacao('ID_USUARIO');

        //NOME - Já existe?
        if (!$this->erro && $metodo != 'Model::alterar') {
            $sql = "SELECT 1 FROM EVENTO WHERE TITULO = '{$this->dado['TITULO']}' LIMIT 1";
            $this->paginacao = false;
            if ($this->listarRetorno($sql)) {
                $this->erro['Título'] = 'Já cadastrado';
            }
        }

        return $this->dadosValidacao();
    }

}
