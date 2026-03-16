<?php
require_once 'core/Router.php';
require_once 'core/Bootstrap.php';
require_once 'core/Layout.php';
require_once 'core/UserOptions.php';
$router = new Router();
$con = Bootstrap::init();
$p = $router->resolver();
$userOptions = new UserOptions($con);
if(!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== 1){
    $_SESSION['logueado'] = 1;
}
$data = [
    'url' => [],
    'aumentar' => [],
];
$data['url'] = ($p==='url' && isset($_GET['parametros'][0]) && !empty($_GET['parametros'][0]) ? $userOptions->obtenerUrl($_GET['parametros'][0]) : null);
if($router->esAjax() && $p !== 'login'){
    Layout::render($p, null, null, $data);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost/proyecto/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst(str_replace('_', ' ', $p)); ?> - Proyecto</title>
    <link rel="stylesheet" href="./assets/css/index.css">
</head>
<body>
    <?php Layout::render($p, null, null,$data); ?>
    <script>
        window.onload = function(){
            document.getElementById('loader').style.display = 'none';
        };
    </script>
    <script src="./assets/js/main.js"></script>
</body>
</html>