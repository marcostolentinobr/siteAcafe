<?
if ($this->Model->buscarCampos) {
    require_once __DIR__ . '/../tamplateBusca.php';
}
?>
<table border="1" style="width: 100%">
    <tr>
        <th>Categoria</th>
        <th>Título</th>
        <th>Texto</th>
        <th>Data</th>
        <th>Imagem</th>
        <th>Ações</th>
    </tr>
    <? while ($dado = $this->qry->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?= reticencias($dado['CATEGORIA'], 15) ?></td>
            <td>
                <a href="<?= URL . "Evento/detalhe/" . $dado['ID_EVENTO'] ?>">
                    <?= reticencias($dado['TITULO'], 15) ?>
                </a>
            </td>
            <td><?= campo(reticencias($dado['TEXTO'], 50)) ?></td>
            <td><?= campo($dado['DATA_PUBLICACAO'], 'DM') ?></td>
            <td><a target="_blank" href="<?= URL . "arquivos/$dado[IMAGEM]" ?>">Abrir</a></td>
            <td><? require __DIR__ . '/../tamplateBotoes.php' ?></td>
        </tr>
    <? } ?>

</table>
<?
require_once __DIR__ . '/../tampletePaginacao.php';
