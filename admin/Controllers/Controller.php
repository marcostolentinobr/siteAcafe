<?php

class Controller {

    protected $acaoDescricaoPost;
    protected $ok;
    protected $msgException;
    protected $arquivoForm;
    protected $botaoFormulario = true;
    protected $listarMostrar = true;
    protected $sistemaLargura = 1000;
    protected $formularioLargura = 500;
    protected $mostrarDescricaoAcao = true;
    protected $acaoDescricao = 'Incluir';
    protected $dado;
    protected $dadoLista;
    protected $erro;
    protected $ID_CHAVE;
    protected $valorChave;
    protected $Model;
    protected $action = CLASSE . '/listar';

    public function __construct() {
        $this->acao();
    }

    protected function acao() {

        $Classe = CLASSE . 'Model';

        $this->Model = new $Classe('', @$_POST['Buscar']);

        $this->ID_CHAVE = @$this->Model->ID_CHAVE;
        $this->valorChave = $this->Model->valorChave;

        if (!isset($_POST['ACAO'])) {
            return;
        }
        $this->acaoDescricaoPost = $_POST['ACAO'];
        try {
            //INCLUIR
            if ($this->acaoDescricaoPost == 'Incluir') {
                $this->validaSetDados();
                $this->msgOk = 'Incluído';
                $this->ok = $this->Model->incluir($this->dado);
            }
            //EDITAR
            elseif ($this->acaoDescricaoPost == 'Editar') {
                $this->Model->paginacao = false;
                $this->Model->addWhere($this->ID_CHAVE, $this->valorChave);
                $this->dado = $this->Model->listar()[0];
                $this->acaoDescricao = 'Alterar';
                $this->Model->paginacao = true;
            }
            //ALTERAR
            elseif ($this->acaoDescricaoPost == 'Alterar') {
                $this->validaSetDados();
                $this->msgOk = 'Alterado';
                $this->ok = $this->Model->alterar($this->dado);
                $this->acaoDescricao = 'Incluir';
            }
            //EXCLUIR
            elseif ($this->acaoDescricaoPost == 'Excluir') {
                $this->msgOk = 'Excluído';
                $this->ok = $this->Model->excluir();
            }
        } catch (Exception $ex) {
            $this->msgException = $ex->getMessage();
            //Caso der erro manter os dados para tratar os erros
            $this->acaoDescricao = $_POST['ACAO'];
            $this->dado = $_POST;
        }
        $this->executaPosAcao();
    }

    protected function executaPosAcao() {
        
    }

    protected function requireForm($arquivo, $acaoDescricao, $botaoFormulario = true) {
        $this->botaoFormulario = $botaoFormulario;
        $this->acaoDescricao = $acaoDescricao;
        $this->arquivoForm = "-$arquivo";
        require_once RAIZ . '/Views/template/mensagemAcao.php';
        require_once RAIZ . '/Views/template/templateFormulario.php';
    }

    protected function templateLista() {
        require_once __DIR__ . '/../Views/template/templateLista.php';
    }

    public function listar() {
        if ($this->listarMostrar) {
            $this->dadoLista = $this->Model->listar();
        }
        require_once RAIZ . '/Views/template/templatePadrao.php';
    }

    public function dadosValidacao() {
        if ($this->erro) {
            $mensagem = '';
            foreach ($this->erro as $campo => $msg) {
                $mensagem .= "<b>$campo</b>: <small>" . ucfirst($msg) . "</small><br>";
            }
            throw new Exception("<div style='color: black'>$mensagem</div>");
        }
        return $this->dado;
    }

    protected function campoValidacao($campoNome, $digitoMaximo = 100, $obrigatorio = true, $numero = false, $digitoMinimo = '') {
        $str = trim($this->dado[$campoNome]);
        $campoNome = ucwords(mb_strtolower(str_replace('_', ' ', $campoNome)));

        if (!$str && $obrigatorio) {
            @$this->erro[$campoNome] .= ' obrigatório, ';
        }

        //MAXIMO CARACTERES ====================================================
        if (strlen($str) > $digitoMaximo) {
            @$this->erro[$campoNome] .= " até $digitoMaximo digitos, ";
        }

        //MAXIMO CARACTERES ====================================================
        if ($digitoMinimo && strlen($str) < $digitoMinimo) {
            @$this->erro[$campoNome] .= " mínimo de $digitoMinimo digitos, ";
        }

        //NUMERO ===============================================================
        if ($numero && !is_numeric($str)) {
            @$this->erro[$campoNome] .= " tem que ser um número, ";
        }

        return true;
    }

}
