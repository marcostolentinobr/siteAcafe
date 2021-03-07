<center>
    <?
    if ($this->acaoDescricaoPost == 'Editar') {
        echo "<img style='max-height: 100px' src='" . URL . "/arquivos/{$this->dado['IMAGEM']}'>";
    }
    ?>
</center>

<!-- CATEGORIA -->
<? $campo = ['CATEGORIA', 'Categoria'] ?>
<label for="<?= $campo[0] ?>"><?= $campo[1] ?>:</label>
<select id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" required autofocus>
    <option></option>
    <? foreach ($this->categoriaLista as $dado) { ?>
        <option value="<?= $dado ?>" <?= (@$this->dado[$campo[0]] == $dado ? 'selected' : '') ?>><?= $dado ?></option>
    <? } ?>
</select>

<!-- TITULO -->
<? $campo = ['TITULO', 'Título', 150] ?>
<label><?= $campo[1] ?>:</label>
<textarea id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" maxlength="<?= $campo[2] ?>" required><?= @$this->dado[$campo[0]] ?></textarea>

<!-- TEXTO -->
<? $campo = ['TEXTO', 'Texto / Url', 8000] ?>
<label><?= $campo[1] ?>:</label>
<small style="color:blue">Texto apenas para notícias, os demais coloque apenas a URL</small><br>
<textarea id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" maxlength="<?= $campo[2] ?>" style="height: 180px" required ><?= @$this->dado[$campo[0]] ?></textarea>
<small>
    <span style="color:blue">Para imagens copie e cole o código a baixo</span><br>
    <?= htmlentities('<img src="http://acafe.org.br/arquivos/acafe/logo.png" style="width: 100%" />'); ?><br>
    <span style="color:blue">onde em src é o link da imagem</span>
</small>
<!-- IMAGEM -->
<? $campo = ['IMAGEM[]', 'Imagem de chamada <small>máximo em 255x200 </small>'] ?>
<label><?= $campo[1] ?></label>
<input type="file" id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" >