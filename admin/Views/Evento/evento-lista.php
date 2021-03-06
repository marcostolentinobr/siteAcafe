<?
if ($this->Model->buscarCampos) {
    require_once __DIR__ . '/../tamplateBusca.php';
}
?>
<table border="1" style="width: 100%">
    <tr>
        <th>Notícia</th>
        <th>Ações</th>
    </tr>
    <? while ($dado = $this->qry->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td>
                <a style="font-size: 17px; color: black" href="<?= URL . "Evento/detalhe/" . $dado['ID_EVENTO'] ?>">
                    <?= $dado['TITULO'] ?>
                </a>
                <br>
                <small>
                    <?
                    echo "<b>$dado[CATEGORIA]</b> publicado(a) em ";
                    echo dataFormatar($dado['DATA_PUBLICACAO'], 'M');
                    ?>
                </small>
            </td>
            <td><? require __DIR__ . '/../tamplateBotoes.php' ?></td>
        </tr>
    <? } ?>

</table>
<?
require_once __DIR__ . '/../tampletePaginacao.php';
