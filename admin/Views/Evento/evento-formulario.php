<center>
    <?
    if ($this->acaoDescricaoPost == 'Editar') {
        echo "<img style='height: 100px' src='" . URL . "/arquivos/{$this->dado['IMAGEM']}'>";
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
<? $campo = ['TITULO', 'Título', 100] ?>
<label><?= $campo[1] ?>:</label>
<input type="text" id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" value="<?= @$this->dado[$campo[0]] ?>" maxlength="<?= $campo[2] ?>" required><br>

<!-- TEXTO -->
<? $campo = ['TEXTO', 'Texto', 3000] ?>
<label><?= $campo[1] ?>:</label>
<textarea id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" maxlength="<?= $campo[2] ?>" style="height: 185px" required ><?= @$this->dado[$campo[0]] ?></textarea>

<!-- IMAGEM -->
<? $campo = ['IMAGEM[]', 'Imagem <small>em 255px200px</small>'] ?>
<label><?= $campo[1] ?></label>
<input type="file" id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" >