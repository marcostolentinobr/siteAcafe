<?php

class Login extends Controller {

    protected $descricao = 'Login';
    protected $acaoDescricao = 'Acessar';
    protected $listarMostrar = false;
    protected $sistemaLargura = 200;
    protected $mostrarDescricaoAcao = false;
    protected $formularioLargura = 0;

    protected function validaSetDados() {

        //CPF  - numero, obrigatório e 11 digitos
        $this->dado['CPF'] = campo($_POST['CPF'], 'I');
        if (!cpfValidar($this->dado['CPF'])) {
            $this->erro['CPF'] = ' inválido ';
        }

        //SENHA  - obrigatório de 3 ate 20 caracteres
        $this->dado['SENHA'] = trim($_POST['SENHA']);
        $this->campoValidacao('SENHA', 20, true, false, 3);

        return $this->dadosValidacao();
    }

    public function acessar() {
        require_once RAIZ . '/Views/template/templatePadrao.php';
    }

    public function sair($redirecionar = true) {
        session_destroy();
        session_start();

        //Caso não exista usuario logado, logue antes
        if ($redirecionar) {
            header('Location: ' . URL . 'Login/acessar');
        }
    }

    protected function acao() {
        parent::acao();

        try {
            //ACESSAR
            if ($this->acaoDescricaoPost == 'Acessar') {
                //Caso for acessar já destruir a sessão
                $this->sair(false);
                $this->validaSetDados();
             
                //Executa
                $this->Model->addWhere('CPF', $this->dado['CPF']);
                $this->Model->addWhere('SENHA', $this->dado['SENHA']);
                $this->dado = @$this->Model->listar()[0];

                //Caso existe usuario e senha salva na sessão
                if ($this->dado) {
                    $_SESSION['USUARIO'] = $this->dado;
                    header('Location: ' . URL);
                }
                //Caso contrário mostrar que os dados não conferem
                else {
                    throw new Exception("<div style='color: black'>Dados não conferem ou sem permissão</div>");
                }

                $this->msgOk = @$_SESSION['msgOk'] = 'Acesso autorizado';
                $this->ok = @$_SESSION['ok'] = isset($this->dado);
            }
        } catch (Exception $ex) {
            $this->msgException = $ex->getMessage();
        }
    }

}
