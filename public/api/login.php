<?php
require_once '../../core/Bootstrap.php';
require_once '../../core/UserOptions.php';
$con = Bootstrap::init();
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$clave = isset($_POST['clave']) ? $_POST['clave'] : '';
$usuario = trim(strip_tags(htmlspecialchars($usuario)));
$clave = trim(strip_tags(htmlspecialchars($clave)));

if($usuario != '' && $clave != ''){
    $userOptions = new UserOptions($con);
    $user = $userOptions->login($usuario, $clave);
    if($user){
        $_SESSION['logueado'] = 1;
        $_SESSION['datos'] = [
            'id' => $user['IdUser'],
            'usuario' => $user['Usuario'],
            'nombre' => $user['Nombre'],
        ];
        echo json_encode([
            'success' => true,
            'message' => 'Login exitoso'
        ]);
    }else{
        echo json_encode([
            'success' => false,
            'message' => 'Usuario o clave incorrectos'
        ]);
        $_SESSION['logueado'] = 0;
    }
}else{
    echo json_encode([
        'success' => false,
        'message' => 'Usuario o clave incorrectos'
    ]);
    $_SESSION['logueado'] = 0;
}
?>