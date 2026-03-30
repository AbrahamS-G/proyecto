<?php
require_once '../core/Auth.php';
require_once '../core/Router.php';
require_once '../core/Bootstrap.php';
require_once '../core/Layout.php';
require_once '../core/UserOptions.php';
require_once '../core/Login.php';
$con = Bootstrap::init();
$router = new Router($con);
$auth = new Autenticador($con);
$p = $router->resolver();
$userOptions = new UserOptions($con);
if($p === 'logout'){
    $login = new Login($con);
    $login->logout();
}

$data = [
    'url' => [],
    'aumentar' => [],
    'urls' => [],
];
$data['url'] = ($p==='url' && isset($_GET['parametros'][0]) && !empty($_GET['parametros'][0]) ? $userOptions->obtenerUrl($_GET['parametros'][0]) : null);
$data['urls'] = ($p==='url' && isset($_SESSION['datos']['id']) && !empty($_SESSION['datos']['id']) && !isset($_GET['parametros'][0]) ? $userOptions->obtenerUrls($_SESSION['datos']['id']) : []);
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