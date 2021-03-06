<? require_once 'config.php' ?>
<title><?= TITULO ?></title>
<link rel="shortcut icon" href="../imagens/favicon.ico">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<style>
    label {
        font-weight: bold;
        display: block;
        padding-top: 5px;
    }
    select, textarea, input[type=text] {
        width: 100%;        
    }

    input[type=submit] {
        width: 55px;        
    }

    .sublinhadoPontilhadoPointer {
        text-decoration: underline; 
        text-decoration-style: dotted; 
        cursor: pointer;
    }

    .sublinhadoPointer {
        text-decoration: underline; 
        cursor: pointer;
    }

</style>
<center>
    <BR>
    <a href="<?= URL ?>Index">INÍCIO</a> |
    <? if (isset($_SESSION['USUARIO'])) { ?>
        <a href="<?= URL ?>Evento/listar">EVENTOS</a> |
        <?
        echo '
            <small 
                class="sublinhadoPontilhadoPointer"
                title="Clique para alterar a senha&#013;' . getSession('NOME') . ' (' . campo(getSession('CPF'), 'CPF') . ')" 
            >
                <a href="' . URL . 'Usuario/alterarSenha">(' . reticencias(getSession('NOME'), 10) . ')</a>
            </small>
        ';
        ?>
        <small> <a href="<?= URL ?>Login/sair"><sup>Sair</sup></a> </small>
    <? } ?>
    <BR>
    <? require_once 'conteudo.php'; ?>
</center>