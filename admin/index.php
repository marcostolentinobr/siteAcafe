<? require_once 'config.php' ?>

<title><?= TITULO ?></title>
<base href="<?= URL ?>" />
<link href="libs/estilo.css" rel="stylesheet">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<center>
    <BR>
    <?
    //Caso não exista usuario logado, logue antes
    if (@!$_SESSION['USUARIO'] && CLASSE != 'Login') {
        //Pode acessar a classe usuário para cadastrar algum
        if (CLASSE != 'Usuario') {
            header('Location: ' . URL . 'Login/acessar');
        }
    }

    require_once 'Views/viewMenu.php';
    echo '<BR>';
    require_once 'Views/viewConteudo.php';
    ?>
</center>

<script src="libs/script.js"></script>