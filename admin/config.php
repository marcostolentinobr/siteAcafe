<?

session_start();

//Title página
define('TITULO', 'Eventos');

/*
  //Conteudo do bd.php
  define('DB_LIB', 'mysql');
  define('DB_HOST', '127.0.0.1');
  define('DB_NAME', 'SITE');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_CHARSET', 'utf8');
 */
require '../../bd.php';
require_once 'funcoes.php';

//URL
$url = [];
if (isset($_GET['pg'])) {
    $url = explode('/', $_GET['pg']);
}
define('CLASSE', isset($url[0]) ? $url[0] : '');
define('METODO', isset($url[1]) ? $url[1] : '');
define('CHAVE', isset($url[2]) ? $url[2] : '');

//DIRETORIO RAIZ
define('RAIZ', __DIR__);

//URL
$protocolo = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false) ? 'http' : 'https';
$url = $protocolo . '://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
define('URL', $url);
define('URL_ATUAL', URL . '/' . CLASSE . '/' . METODO);
