<?php   
class Router{
    public function __construct(){
    }
    public function esAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
    public function resolver(){
        $uri = str_replace('/proyecto', '', $_SERVER['REQUEST_URI']);
        $uri = parse_url($uri, PHP_URL_PATH);
        $base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

        if(strpos($uri, $base) === 0){
            $uri = substr($uri, strlen($base));
        }
        $segmentos = explode('/',trim($uri,'/'));

        $p = !empty($segmentos[0]) ? $segmentos[0] : 'inicio';
        $p = preg_replace('/[^a-zA-Z0-9_-]/', '', $p);
        $_GET['parametros'] = array_slice($segmentos, 1);
        
        if($p === 'login' && isset($_SESSION['logueado']) && $_SESSION['logueado'] == 1){
            echo "<script>cargarPagina('./inicio', true, 'Inicio');</script>";
            exit;
        }else
        if(!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== 1 && $p !== "starting"){
            $p = 'starting';
        }
        if($p === 'starting' && isset($_SESSION['logueado']) && $_SESSION['logueado'] === 1){
            $p = 'inicio';
        }
        
        return $p;
    }
}
