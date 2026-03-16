<?php   
class Router{
    public function __construct(){
    }
    public function resolver(){
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

        if(strpos($uri, $base) === 0){
            $uri = substr($uri, strlen($base));
        }
        $segmentos = explode('/',trim($uri,'/'));

        $p = !empty($segmentos[0]) ? $segmentos[0] : 'inicio';
        $p = preg_replace('/[^a-zA-Z0-9_-]/', '', $p);
        $_GET['parametros'] = array_slice($segmentos, 1);
        
        if($p === 'login' && isset($_SESSION['logueado']) && $_SESSION['logueado'] == 1){
            header('location: ./');
            exit;
        }else
        if(!isset($_SESSION['logueado']) && $p !== "landing"){
            header('location: ./landing');
            exit;
        }
        
        return $p;
    }
}
