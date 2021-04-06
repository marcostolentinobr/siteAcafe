<?

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

session_start();

//BANCO DE DADOS
//Conteudo do bd.php
//define('DB_LIB', 'dblib');

//Drive
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('DB_LIB', 'sqlsrv');
} else {
    define('DB_LIB', 'dblib');
}

define('DB_HOST', '10.0.0.3');
define('DB_NAME', 'WEB_PORTAL');
define('DB_USER', 'sa');
define('DB_PASS', 'm0n5t&rw1f12016#');
define('DB_CHARSET', 'utf8');

//require_once '../../bd_crudPhpMvcPdoJs.php';
//Title
define('TITULO', 'Eventos');
define('DB_CONVERTE_UTF8', TRUE);

//Funções
require_once 'libs/funcoes.php';
iniciar();
