<?

$tp = $this->Model->linhasTotal / $this->Model->pagina_total;
$pagina = coalesce(@$_GET['pagina'], 1);
$anterior = $pagina - 1;
$proximo = $pagina + 1;
echo "
    <div>
        <small style='float: left'>{$this->Model->linhasTotalMomento} de {$this->Model->linhasTotal}</small>
        <small>
";
if ($pagina > 1) {
    echo " <a href='" . URL_ATUAL . "/&pagina=$anterior'><- Anterior</a> ";
}
echo "|";
if ($pagina < $tp) {
    echo " <a href='" . URL_ATUAL . "/&pagina=$proximo'>Próxima -></a>";
}
echo "  
        </small>
    </div>
";
