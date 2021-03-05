<?

echo "<b>Categoria:</b>{$this->dado['CATEGORIA']}<BR>";
echo "<b>Título:</b>{$this->dado['TITULO']}<BR>";
echo "<b>Texto:</b>" . campo($this->dado['TEXTO'], 'T') . "<BR>";
echo "<b>Publicação:</b>" . campo($this->dado['DATA_PUBLICACAO'], 'DM') . "<BR>";
echo "<img src='" . URL . "/arquivos/{$this->dado['IMAGEM']}'>";

