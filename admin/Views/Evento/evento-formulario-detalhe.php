<?

$VIRTUAL = URL . "arquivos/";
$ind = 0;

echo "<b>Categoria:</b>{$this->dado['CATEGORIA']}<BR>";
echo "<b>Título:</b>{$this->dado['TITULO']}<BR>";
echo "<b>Texto:</b>".campo($this->dado['TEXTO'],'T')."<BR>";
echo "<b>Publicação:</b>" . campo($this->dado['DATA_PUBLICACAO'], 'DM') . "<BR>";

foreach (mArquivosListar(RAIZ . "/arquivos/" . CHAVE) as $nome => $arquivo) {
    $ind++;
    echo "<a target='_blank' href='{$VIRTUAL}{$nome}'>Arquivo $ind</a> ";
    if (getSession('ID_USUARIO') == @$this->dado['ID_USUARIO']) {
        echo "<input name='" . base64_encode("EXCLUIR-$nome") . "' value='X' type='submit'>";
    }
    echo '<br>';
}

if (!$ind) {
    echo 'Sem arquivos cadastrados';
}