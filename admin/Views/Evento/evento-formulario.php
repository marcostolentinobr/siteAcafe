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
<? $campo = ['TITULO', 'Título'] ?>
<label><?= $campo[1] ?>:</label>
<input id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" value="<?= @$this->dado[$campo[0]] ?>" minlength="1" maxlength="100" required><br>

<!-- TEXTO -->
<? $campo = ['TEXTO', 'Texto'] ?><label><?= $campo[1] ?>:</label>
<textarea id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" maxlength="1000" required style="height: 100px" ><?= @$this->dado[$campo[0]] ?></textarea>

<label style="font-weight: normal">Comprovante de título:</label>
<input type="file" name="ARQUIVO[]" ><br>

<?
if ($this->acaoDescricaoPost == 'Editar') {
    echo "<img src='" . URL . "/arquivos/{$this->dado['IMAGEM']}'>";
}
?>
