<?php

class Conexao {

    private $pdo;
    public $linhasTotal;
    protected $where = [];
    protected $group = [];
    protected $order = [];

    public function __construct($pdo = '') {
        if ($pdo) {
            $this->pdo = $pdo;
        }
        $this->pdo = $this->pdo();
    }

    public function ultimoInsertId() {
        $this->where = [];

        //Windows
        if (DB_LIB == 'dblib') {
            $retorno = $this->getListar('SELECT scope_identity() AS ID');
            //return $this->pdo->lastInsertId();
        } else {
            $retorno = $this->getListar('SELECT LAST_INSERT_ID() AS ID');
        }
        return $retorno[0]['ID'];
    }

    public function addWhere($coluna, $valor, $metodo = '=') {
        if (is_array($valor)) {
            $valor = "('" . implode("','", $valor) . "')";
        } elseif ($metodo == 'IN' || $metodo == 'NOT IN') {
            $valor = "($valor)";
        }
        if ($metodo == 'updateExcluir') {
            $this->where[$coluna] = $valor;
        } elseif ($metodo != '=') {
            $this->where[] = " $coluna $metodo $valor ";
        } else {
            $this->where[] = " $coluna = '$valor' ";
        }
    }

    public function addOrder($coluna) {
        $this->order[] = $coluna;
    }

    public function getListar($sql, $sulfixo = '') {
        if (!is_array($sql)) {
            $sql = array($sql);
        }
        if (!empty($this->where)) {
            $sql[] = sprintf(" \n WHERE %s ", implode(" \n AND ", $this->where));
        }
        if (!empty($this->group)) {
            $sql[] = sprintf(" \n GROUP BY %s ", implode(" ,  \n ", $this->group));
        }
        if (!empty($this->order)) {
            $sql[] = sprintf(" \n ORDER BY %s ", implode(" , \n ", $this->order));
        }
        $sql = implode(' ', $sql);
        $acao = $this->prepareExecute("$sql $sulfixo", [], true);

        $this->where = [];
        $this->order = [];
        $this->group = [];

        $retorno = $acao->fetchAll(PDO::FETCH_ASSOC);
        foreach ($retorno as $ind => $valor) {
            if (DB_CONVERTE_UTF8) {
                $retorno[$ind] = array_map('utf8_encode', $valor);
            } else {
                $retorno[$ind] = $valor;
            }
        }

        $this->linhasTotal = count($retorno);
        return $retorno;
    }

    protected function incluir($tabela, $valores) {
        $dadosIncluir = $this->dadosQry($valores, true);
        $sql = "INSERT INTO $tabela  ( " . implode(", ", $dadosIncluir['sintaxe']);
        $sql .= ') VALUES ( :' . implode(", :", $dadosIncluir['sintaxe']) . ')';
        return $this->prepareExecute($sql, $dadosIncluir['valores']);
    }

    protected function alterar($tabela, $valores) {
        $dadosAlterar = $this->dadosQry($valores, false);
        $dadosWhere = $this->dadosQry($this->where, false);
        $sql = "UPDATE $tabela SET " . implode(", ", $dadosAlterar['sintaxe']);
        $sql .= ' WHERE ' . implode(' AND ', $dadosWhere['sintaxe']);
        return $this->prepareExecute($sql, array_merge($dadosAlterar['valores'], $dadosWhere['valores']));
    }

    protected function excluir($tabela) {
        $dadosWhere = $this->dadosQry($this->where, false);
        $sql = "DELETE FROM $tabela ";
        $sql .= ' WHERE ' . implode(' AND ', $dadosWhere['sintaxe']);
        return $this->prepareExecute($sql, $dadosWhere['valores']);
    }

    protected function pdo() {
        try {
            if ($this->pdo) {
                return $this->pdo;
            }

            //GERAL
            $hostServer = ':host=' . DB_HOST;
            $nameDb = ';dbname=' . DB_NAME;
            $charset = ';charset=' . DB_CHARSET;

            //SQL SERVER 
            if (DB_LIB == 'sqlsrv') {
                $hostServer = ':Server=' . DB_HOST;
                $nameDb = ';Database=' . DB_NAME;
                $charset = '';
            }

            $this->pdo = new PDO(DB_LIB . $hostServer . $nameDb . $charset, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //pr($e);
            exit('<br><b>Erro de conexao. Entre em contato</b>');
        }
        return $this->pdo;
    }

    private function prepareExecute($sql, $dados = [], $listar = false) {

        $this->where = [];
        $this->order = [];
        $this->group = [];

        $acao = $this->pdo->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
        //pr($acao);
        $execute = $acao->execute($dados);
        return ($listar ? $acao : $execute);
    }

    private function dadosQry($dados, $insert = false) {
        $ITEM = [];
        $ITEM['sintaxe'] = [];
        $ITEM['valores'] = [];
        foreach ($dados as $coluna => $valor) {
            if (!empty($valor) || $valor === '0') {
                if ($insert) {
                    $ITEM['sintaxe'][] = "$coluna";
                } else {
                    $ITEM['sintaxe'][] = "$coluna=:$coluna";
                }
                $key = ":$coluna";
                //$ITEM['valores'][$key] = $valor === 'NULL' ? null : $valor;
                $ITEM['valores'][$key] = $valor === 'NULL' ? null : (DB_CONVERTE_UTF8 ? utf8_decode($valor) : $valor);
            }
        }
        return $ITEM;
    }

    private function addGroup($coluna) {
        $this->group[] = $coluna;
    }

}
