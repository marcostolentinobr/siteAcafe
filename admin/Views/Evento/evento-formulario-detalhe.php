<h2><?= $this->dado['TITULO'] ?></h2>
<img style='width: 255px; height: 200px' src='<?= URL . "/arquivos/{$this->dado['IMAGEM']}" ?>' ><br>
<div style="border: 0px solid; text-align: left; width: <?= $this->listarLargura ?>px">    
    <small>
        <b><?= $this->dado['CATEGORIA'] ?> </b> 
        publicado(a) em <?= dataFormatar($this->dado['DATA_PUBLICACAO'], 'DM', false) ?>
    </small>
    <br><br>
    <?= campo($this->dado['TEXTO'], 'T') ?>
</div>
<BR>
<input name="ACAO" value="Editar" type="submit">
