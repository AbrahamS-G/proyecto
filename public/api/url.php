<?php
require_once '../../core/Bootstrap.php';
require_once '../../core/UserOptions.php';
$con = Bootstrap::init();
$userOptions = new UserOptions($con);
$url = $_POST['url'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$idUser = $_SESSION['datos']['id'] ?? null;
$eliminar = isset($_POST['eliminar']) ? $_POST['eliminar'] : false;
if($eliminar){
    $url = $_POST['url'] ?? null;
    $idUser = $_SESSION['datos']['id'] ?? null;
    if(!$url){
        echo json_encode([
            'success' => false,
            'message' => 'No se recibió la URL'
        ]);
        exit;
    }else{
        $result = $userOptions->eliminarUrl($url, $idUser);
        if($result){
            echo json_encode([
                'success' => true,
                'message' => 'URL eliminada correctamente'
            ]);
            exit;
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'No se pudo eliminar la URL'
            ]);
            exit;
        }
    }
}else if(!$url){
    echo json_encode([
        'success' => false,
        'message' => 'No se recibió la URL'
    ]);
    exit;
}else if(!$nombre){
    echo json_encode([
        'success' => false,
        'message' => 'No se recibió el nombre'
    ]);
    exit;
}else{
    $url = $userOptions->crearUrl($url, $nombre, $idUser);
    echo json_encode([
        'success' => true,
        'url' => $url
    ]);
    exit;
}