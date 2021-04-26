<?

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../../../parametros/bd_site.php';

//Title
define('TITULO', 'Eventos');

//Funções
require_once 'libs/funcoes.php';
iniciar();
