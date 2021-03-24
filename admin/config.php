<?

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

session_start();

//BANCO DE DADOS
define('DB_LIB', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'SITE');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');

//require_once '../../bd_crudPhpMvcPdoJs.php';
//Title
define('TITULO', 'Eventos');
define('DB_CONVERTE_UTF8', FALSE);

//Funções
require_once 'libs/funcoes.php';
iniciar();
