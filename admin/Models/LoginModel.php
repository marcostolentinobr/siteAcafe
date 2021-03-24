<?php

class LoginModel extends Model {

    public $tabela = 'USUARIO';
    public $ID_CHAVE = 'ID_USUARIO';

    public function listar() {
        $sql = "SELECT * FROM USUARIO";
        if (ehSqlServer()) {
            $this->addWhere('PERFIL', 'ACAFE');
        }
        return $this->listaRetorno($sql);
    }

}
