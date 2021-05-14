<?
require_once __DIR__ . '/../template/templateBusca.php';

$ascDesc = 'DESC';
if (isset($_GET['order'])) {
    $campoOrder = explode('@', $_GET['order']);
    if ($campoOrder[1] == $ascDesc) {
        $ascDesc = 'ASC';
    }
}
?>
<table class="table">
    <thead>
        <tr>
            <th><a style="color: black" href='<?= URL_ATUAL . "&order=TITULO@{$ascDesc}" ?>'>Notícia</a></th>
            <th style="width: 1%" >Ações</th>
        </tr>
    </thead>
    <tbody>
        <? foreach ($this->dadoLista as $dado) { ?>
            <tr>
                <td>
                    <a style="font-size: 17px; color: black" 
                       href="<?= URL . "Evento/detalhe/" . $dado['ID_EVENTO'] ?>"
                       title="<?= $dado['TITULO'] ?>"
                       >
                           <?= reticencias($dado['TITULO'], 38) ?>
                    </a>
                    <br>
                    <small>
                        <?
                        echo "<b>$dado[CATEGORIA]</b> publicado(a) em ";
                        echo dataFormatar($dado['DATA_PUBLICACAO'], 'M');
                        ?>
                    </small>
                </td>
                <td><? require __DIR__ . '/../template/templateBotoes.php'; ?></td>
            </tr>
        <? } ?>
    </tbody>
</table>
<?
require_once __DIR__ . '/../template/templatePaginacao.php';
