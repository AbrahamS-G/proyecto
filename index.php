<?php
require_once 'core/Router.php';
require_once 'core/Bootstrap.php';
require_once 'core/Layout.php';
$router = new Router();
$con = Bootstrap::init();
$p = $router->resolver();
if(!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== 1){
    $_SESSION['logueado'] = 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto</title>
    <link rel="stylesheet" href="./assets/css/index.css">
</head>
<body>
    <?php Layout::render($p, null, null); ?>
    <script src="./assets/js/main.js"></script>
</body>
</html>