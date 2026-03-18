<?php
require_once '../../core/Bootstrap.php';
require_once '../../core/UserOptions.php';
$con = Bootstrap::init();
$userOptions = new UserOptions($con);
$url = $_POST['url'] ?? null;
$idUser = $_SESSION['IdUser'] ?? null;

if(!$url){
    echo json_encode([
        'success' => false,
        'message' => 'No se recibió la URL'
    ]);
    exit;
}else{
    $url = $userOptions->crearUrl($url, $idUser);
    echo json_encode([
        'success' => true,
        'url' => $url
    ]);
    exit;
}