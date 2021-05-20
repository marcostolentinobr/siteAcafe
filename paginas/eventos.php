<?
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '../admin/config.php';
require_once '../admin/libs/Conexao.php';

$pdo = new Conexao();

if ($_GET['CATEGORIA'] == 'Notícia' && DB_HOST == '10.0.0.3') {
    $_GET['CATEGORIA'] = 'Noticia';
}

$pdo->addWhere('CATEGORIA', $_GET['CATEGORIA']);

//id_evento
if (isset($_GET['ID_EVENTO'])) {
    $pdo->addWhere('ID_EVENTO', $_GET['ID_EVENTO']);
}

//order e limit
$limit = '';
$top = '';
if (@$_GET['LIMIT']) {
    if (ehSqlServer()) {
        $top = " TOP $_GET[LIMIT] ";
    } else {
        $limit = " LIMIT  $_GET[LIMIT] ";
    }
}

$sql = "
    SELECT $top *, CAST(TEXTO AS VARCHAR(MAX)) AS TEXTO_TOTAL 
      FROM EVENTO 
";

$pdo->addOrder("DATA_PUBLICACAO DESC");

//retorno
$EVENTO = $pdo->getListar($sql, $limit);

if (isset($_GET['ID_EVENTO'])) {
    $EVENTO = $EVENTO[0];

    $img_path = pathinfo($EVENTO['IMAGEM']);
    $img_interno = "../admin/arquivos/$img_path[filename]_interno.$img_path[extension]";
    ?>
    <h1 style="font-weight: bold; font-size: 30px; line-height: 35px; text-align: center"><?= $EVENTO['TITULO'] ?></h1>
    <br>
    <div style="border: 0px solid; text-align: left; font-size: 15px">    
        <? if ($EVENTO['IMAGEM_APARECER_DETALHE'] != 'N') { ?>
            <img style='max-width: 255px; max-height: 200px' src='admin/arquivos/<?= $EVENTO['IMAGEM'] ?>' ><br> 
        <? } elseif (file_exists($img_interno)) { ?>
            <img style="width: 100%" src='<?= str_replace('../', '', $img_interno) ?>' ><br> 
        <? } ?>

        <small style="font-size: 10px"> 
            Publicada em <?= dataFormatar($EVENTO['DATA_PUBLICACAO'], 'DM', false) ?>
        </small>
        <br><br>
        <?= campo($EVENTO['TEXTO_TOTAL'], 'T') ?>
    </div>
    <BR>
    </center>
    <?
} else {
    foreach ($EVENTO as $evento) {

        $attr = " target='_blank' href='$evento[TEXTO]' ";
        $cssHeigth = ' height: 50px; text-align: center ';
        if (in_array(@$_GET['CATEGORIA'], ['Notícia', 'Noticia'])) {
            $attr = " onclick='noticiaDetalhe($evento[ID_EVENTO])' ";
            $cssHeigth = ' height: 66px ';
        }

        $img = "admin/arquivos/$evento[IMAGEM]";
        if (!file_exists("../$img")) {
            $img = "admin/arquivos/9.png";
        }
        
        ?>
        <a class="col-md-3 col-sm-4" style="cursor: pointer; font-weight: bold; margin-top: 50px; " title="<?= $evento['TITULO'] ?>" <?= $attr ?> >
            <div class="team-member" style="text-align: center">
                <div class="member-img">
                    <img style="max-height: 200px; width: 255px; "  src="<?= $img ?>">
                </div>
                <center>
                    <div class="inner-content" style=" background: whitesmoke;
                         border: 1px solid #d6d6d6;
                         border-top: 0;
                         padding: 20px;
                         width: 255px
                         ">
                        <small style="font-size: 10px; color: silver; font-weight: normal">Publicado em <?= dataFormatar($evento['DATA_PUBLICACAO'], 'M') ?></small>
                        <h5 style="<?= $cssHeigth ?>;">
                            <?= reticencias($evento['TITULO'], '54') ?>
                        </h5>
                    </div>
                </center>
            </div> 
        </a>
        <?
    }
} 