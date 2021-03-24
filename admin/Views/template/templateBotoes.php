<form method="POST" style="display: inline">
    <input name="<?= $this->ID_CHAVE ?>" value="<?= $dado[$this->ID_CHAVE] ?>" hidden>
    <input id="ACAO" name="ACAO" value="Editar" type="submit"><br>
    <input id="ACAO" name="ACAO" value="Excluir" onclick="excluir(form)" type="submit">
</form>