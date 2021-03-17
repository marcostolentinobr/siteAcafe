<?
require_once '../admin/config.php';
require_once '../admin/Models/Model.php';

$pdo = new Model('', false);

$sql = "
    SELECT * 
      FROM EVENTO 
";

//categoria
$where = ['CATEGORIA' => $_GET['CATEGORIA']];

//id_evento
if (isset($_GET['ID_EVENTO'])) {
    $where['ID_EVENTO'] = $_GET['ID_EVENTO'];
}

//order e limit
$limit = '';
if (@$_GET['LIMIT']) {
    $limit = " LIMIT  $_GET[LIMIT] ";
}
$pdo->addOrder("DATA_PUBLICACAO DESC $limit");

//retorno
$EVENTO = $pdo->listarRetorno($sql, @$where);

if (isset($_GET['ID_EVENTO'])) {
    $EVENTO = $EVENTO[0];
    ?>
    <center>
        <h1 style="font-weight: bold; font-size: 30px; line-height: 35px"><?= $EVENTO['TITULO'] ?></h1>
        <br>
        <img style='max-width: 255px; max-height: 200px' src='admin/arquivos/<?= $EVENTO['IMAGEM'] ?>' ><br>
        <div style="border: 0px solid; text-align: left; font-size: 15px">    
            <small style="font-size: 10px"> 
                Publicada em <?= dataFormatar($EVENTO['DATA_PUBLICACAO'], 'DM', false) ?>
            </small>
            <br><br>
            <?= campo($EVENTO['TEXTO'], 'T') ?>
        </div>
        <BR>
    </center>
    <?
} else {
    foreach ($EVENTO as $evento) {
        $attr = " target='_blank' href='$evento[TEXTO]' ";
        $cssHeigth = ' height: 50px; text-align: center ';
        if ($_GET['CATEGORIA'] == 'Notícia') {
            $attr = " onclick='noticiaDetalhe($evento[ID_EVENTO])' ";
            $cssHeigth = ' height: 66px ';
        }
        ?>
        <a class="col-md-3 col-sm-4" style="cursor: pointer; font-weight: bold; margin-top: 50px" title="<?= $evento['TITULO'] ?>" <?= $attr ?> >
            <div class="team-member" style="max-width: 255px">
                <div class="member-img">
                    <img style="max-height: 200px; width: 100%; "  src="admin/arquivos/<?= $evento['IMAGEM'] ?>">
                </div>
                <div class="inner-content" style=" background: whitesmoke;
                     border: 1px solid #d6d6d6;
                     border-top: 0;
                     padding: 20px;">
                    <small style="font-size: 10px; color: silver; font-weight: normal">Publicado em <?= dataFormatar($evento['DATA_PUBLICACAO'], 'M') ?></small>
                    <h5 style="<?= $cssHeigth ?>;">

                        <?= reticencias($evento['TITULO'], '54') ?>

                    </h5>
                </div>
            </div> 
        </a>
        <?
    }
} 