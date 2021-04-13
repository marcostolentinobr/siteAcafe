<center>
    <?
    if ($this->acaoDescricaoPost == 'Editar') {
        echo "<img style='max-height: 100px' src='" . URL . "/arquivos/{$this->dado['IMAGEM']}'>";
    }
    ?>
</center>

<!-- CATEGORIA -->
<? $campo = ['CATEGORIA', 'Categoria', 'select', 100, ' required '] ?>
<label for="<?= $campo[0] ?>"><?= $campo[1] ?>:</label>
<select id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" <?= $campo[4] ?>>
    <option></option>
    <? foreach ($this->categoriaLista as $dado) { ?>
        <option value="<?= $dado ?>" <?= (@$this->dado[$campo[0]] == $dado ? 'selected' : '') ?>><?= $dado ?></option>
    <? } ?>
</select>

<!-- TITULO -->
<? $campo = ['TITULO', 'Título', 'textarea', 150, ' required '] ?>
<label><?= $campo[1] ?>:</label>
<textarea id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" maxlength="<?= $campo[3] ?>" <?= $campo[4] ?>><?= @$this->dado[$campo[0]] ?></textarea>

<!-- TEXTO -->
<? $campo = ['TEXTO', 'Texto / Url', 'textarea', 8000, ' style="height: 180px" required  '] ?>
<label><?= $campo[1] ?>:</label>
<small style="color:blue">Texto apenas para notícias, os demais coloque apenas a URL</small><br>
<textarea id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" maxlength="<?= $campo[3] ?>" <?= $campo[4] ?>><?= @$this->dado[$campo[0]] ?></textarea>
<small>
    <span style="color:blue">Para imagens copie e cole o código a baixo</span><br>
    <?= htmlentities('<img src="http://acafe.org.br/arquivos/acafe/logo.png" style="width: 100%" />'); ?><br>
    <span style="color:blue">onde em src é o link da imagem</span><BR><BR>
    <span style="color:blue">Para links copie e cole o código a baixo</span><br>
    <?= htmlentities("<a href='https://acafe.org.br' target='_blank'>DESCRIÇÃO</a>"); ?><br>
    <span style="color:blue">onde é href coloque o link do site e altere a descrição em DESCRIÇÃO</span>
</small>

<!-- IMAGEM_APARECER_DETALHE -->
<? $campo = ['IMAGEM_APARECER_DETALHE', 'Imagem no detalhe', 'select', 100, ' required '] ?>
<label for="<?= $campo[0] ?>"><?= $campo[1] ?>:</label>
<select id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" <?= $campo[4] ?>>
    <option value="S" <?= (@$this->dado[$campo[0]] == 'S' ? 'selected' : '') ?>>Sim</option>
    <option value="N" <?= (@$this->dado[$campo[0]] == 'N' ? 'selected' : '') ?>>Não</option>
</select>



<!-- IMAGEM -->
<? $campo = ['IMAGEM[]', 'Imagem de chamada <small>máximo em 255x200 </small>', 'file'] ?>
<label><?= $campo[1] ?></label>
<input type="<?= $campo[2] ?>" id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" >