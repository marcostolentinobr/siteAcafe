<?
require_once '../admin/config.php';
require_once '../admin/Models/Model.php';
$pdo = new Model();
$EVENTO = $pdo->listarRetorno('SELECT * FROM EVENTO');

pr($EVENTO);
?>

<div class="col-md-3 col-sm-4">
    <div class="team-member">
        <div class="member-img">
            <img style="height: 200px" src="<?= imagens/noticia/posse.jpg">
        </div>
        <div class="inner-content" style="padding-top: 0">
            <small style="font-size: 10px">17/12/2020</small>
            <h5>Nova diretoria</h5>
            <p>ACAFE empossa nova diretoria em cerimônia virtual prestigiada</p>
            <span><a target="_blank" href="https://new.acafe.org.br/portaria-09-2020-calendario-vestibular-inverno-2021-e-verao-2022/">Ler mais</a></span>
        </div>
    </div> 
</div>

