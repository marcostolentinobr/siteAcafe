<?php

class EventoModel extends Model {

    public $tabela = 'EVENTO';
    public $ID_CHAVE = 'ID_EVENTO';
    public $buscarCampos = ['TITULO'];
    
    public function listar() {
        if (!ehSqlServer()) {
            $this->addOrder('DATA_PUBLICACAO DESC');
            return parent::listar();
        } else {
            $sql = "
            SELECT E.*,
                   CAST(E.TEXTO AS VARCHAR(MAX)) AS TEXTO
              FROM EVENTO E
        ";

            $this->addOrder('DATA_PUBLICACAO DESC');
            return $this->listaRetorno($sql);
        }
    }

}
