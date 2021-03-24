<?php

class Usuario extends Controller {

    protected $descricao = 'Usuário';
    protected $sistemaLargura = 200;
    protected $listarMostrar = false;

    //DADOS
    protected function validaSetDados() {

        //SENHA - Obrigatório e até 20 caracteres
        $this->dado['SENHA'] = campo($_POST['SENHA']);
        $this->campoValidacao('SENHA', 20);

        //Senha tem que ser a mesma que a senha da sessão
        if ($_POST['SENHA_ATUAL'] != getSession('SENHA')) {
            $this->erro['CPF'] = 'Senha atual inválida';
        }

        return $this->dadosValidacao();
    }

    public function alterarSenha() {
        $this->dado = getSession();
        $this->valorChave = $this->dado['ID_USUARIO'];
        $this->action = 'Usuario/alterarSenha';
        $this->requireForm('senha', 'Alterar');
    }

    protected function executaPosAcao() {
        if ($this->ok == 1 && getSession()) {
            setSession('SENHA', $this->dado['SENHA']);
        }
    }

}
