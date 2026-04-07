<?php
require_once '../../core/Bootstrap.php';
require_once '../../core/Login.php';
$con = Bootstrap::init();
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$clave = isset($_POST['clave']) ? $_POST['clave'] : '';
$usuario = trim(strip_tags(htmlspecialchars($usuario)));
$clave = trim(strip_tags(htmlspecialchars($clave)));

if($usuario != '' && $clave != ''){
    $login = new Login($con);
    $user = $login->log($usuario, $clave);
    if($user['success']){
        echo json_encode([
            'success' => true,
            'id' => $_SESSION['datos']['id'],
            'nombre' => $_SESSION['datos']['nombre'],
            'message' => 'Login exitoso'
        ]);
    }else{
        echo json_encode([
            'success' => false,
            'message' => 'Usuario o clave incorrectos'
        ]);
    }
}else{
    echo json_encode([
        'success' => false,
        'message' => 'Usuario o clave incorrectos'
    ]);
    $_SESSION['logueado'] = 0;
}
?>