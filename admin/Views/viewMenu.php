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