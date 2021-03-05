<?php

class EventoModel extends Model {

    public $tabela = 'EVENTO';
    public $chave = 'ID_EVENTO';
    public $buscarCampos = ['TITULO'];

    //DADOS
    protected function dado($dado, $metodo = __METHOD__) {

        //CATEGORIA obrigatorio
        $this->dado['CATEGORIA'] = campo($dado['CATEGORIA']);
        $this->campoValidacao('CATEGORIA');
        
        //TITULO obrigatorio 100
        $this->dado['TITULO'] = campo($dado['TITULO']);
        $this->campoValidacao('TITULO');

        //TEXTO obrigatorio 3000
        $this->dado['TEXTO'] = campo($dado['TEXTO']);
        $this->campoValidacao('TEXTO', 3000);
        
        //CATEGORIA obrigatorio
        $this->dado['IMAGEM'] = campo(date('Ymd_His'));
        $this->campoValidacao('IMAGEM');

        //ID_USUARIO obrigatório
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
