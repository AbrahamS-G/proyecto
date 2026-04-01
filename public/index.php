<?php
require_once '../core/Bootstrap.php';
$con = Bootstrap::init();
$router = new Router($con);
$auth = new Autenticador($con);
$handler = new DataHandler($con);

$p = $router->resolver();

if($p === 'logout'){
    $login = new Login($con);
    $login->logout();
}

$data = $handler->obtenerDatosParaVista($p);
if($router->esAjax() && $p !== 'login'){
    Layout::render($p, $auth, null, $data);
    exit;
}
?>
<div id="notificacionesToast"></div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="http://<?=$_SERVER['HTTP_HOST']?>/proyecto/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst(str_replace('_', ' ', $p)); ?> - Proyecto</title>
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/toast.css">
</head>
<body>
    <?php Layout::render($p, $auth, null,$data); ?>
    <script>
        window.onload = function(){
            document.getElementById('loader').style.display = 'none';
        };
    </script>
</body>
</html>