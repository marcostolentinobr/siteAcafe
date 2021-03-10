<?
require_once '../admin/config.php';
require_once '../admin/Models/Model.php';

$pdo = new Model('', false);

$top = '';
$limit = '';
if (ehSqlServer() && @$_GET['LIMIT']) {
    $top = " TOP $_GET[LIMIT] ";
} else if (@$_GET['LIMIT']) {
    $limit = " LIMIT $_GET[LIMIT] ";
}
$pdo->addOrder("DATA_PUBLICACAO DESC $limit");

$sql = "
    SELECT $top * 
      FROM EVENTO 
";
if ($_GET['CATEGORIA'] != '*') {
    $where = ['CATEGORIA' => $_GET['CATEGORIA']];
} else {
    $sql .= " WHERE CATEGORIA IN ('Sua','Vestibular') ";
    //$where = ['CATEGORIA' => $_GET['CATEGORIA']];
}
if (@$_GET['ID_EVENTO']) {
    $where['ID_EVENTO'] = $_GET['ID_EVENTO'];
}

$EVENTO = $pdo->listarRetorno($sql, @$where);
IF ($_GET['CATEGORIA'] != '*') {

    if (!isset($_GET['ID_EVENTO'])) {
        foreach ($EVENTO as $evento) {
            ?>
            <div class="col-md-3 col-sm-4" style="margin-top: 50px">
                <div class="team-member" style="max-width: 255px">
                    <div class="member-img">
                        <img style="max-height: 200px;" src="admin/arquivos/<?= $evento['IMAGEM'] ?>">
                    </div>
                    <div class="inner-content" style="padding-top: 0">
                        <small style="font-size: 10px"><?= dataFormatar($evento['DATA_PUBLICACAO'], 'M') ?></small>
                        <h5>
                            <a style="cursor: pointer" onclick="noticia(<?= $evento['ID_EVENTO'] ?>)">
                                <?= reticencias($evento['TITULO'], '54') ?>
                            </a>
                        </h5>
                    </div>
                </div> 
            </div>
            <?
        }
    } else {
        $EVENTO = $EVENTO[0];
        ?>
        <center>
            <h1 style="font-weight: bold; font-size: 30px"><?= $EVENTO['TITULO'] ?></h1>
            <br>
            <img style='max-width: 255px; max-height: 200px' src='admin/arquivos/<?= $EVENTO['IMAGEM'] ?>' ><br>
            <div style="border: 0px solid; text-align: left; font-size: 15px">    
                <small style="font-size: 10px">
                    <b><?= $EVENTO['CATEGORIA'] ?> </b> 
                    publicado(a) em <?= dataFormatar($EVENTO['DATA_PUBLICACAO'], 'DM', false) ?>
                </small>
                <br><br>
                <?= campo($EVENTO['TEXTO'], 'T') ?>
            </div>
            <BR>
        </center>
        <?
    }
} ELSE IF ($_GET['CATEGORIA'] == '*') {

    foreach ($EVENTO as $evento) {
        ?>

        <div class="col-md-3 col-sm-4"  style="margin-top: 50px">
            <div class="team-member" style="max-width: 255px">
                <div class="member-img">
                    <center>
                        <img style="max-height: 200px; width: 100%" src='admin/arquivos/<?= $evento['IMAGEM'] ?>'>
                    </center>
                </div>
                <div class="inner-content" style=" background: whitesmoke;
                     border: 1px solid #d6d6d6;
                     border-top: 0;
                     padding: 20px;">
                    <small style="font-size: 10px"><?= dataFormatar($evento['DATA_PUBLICACAO'], 'M') ?></small>
                    <h5>
                        <a target="_blank" style="cursor: pointer" href="<?= $evento['TEXTO'] ?>">
                            <?= reticencias($evento['TITULO'], '54') ?>
                        </a>
                    </h5>
                </div>
            </div> 
        </div>
        <?
    }
}
?>
