<?php   
class Router{
    private $con;
    public function __construct($con){
        $this->con = $con;
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

        if($p == 'url' && isset($_GET['parametros'][0])){
            return $p;
        }
        if(!isset($_SESSION['logueado']) && isset($_COOKIE['proyectoToken'])){
            $auth = new Autenticador($this->con);
            $auth->validar();
        }
        if($p == 'login' || $p == 'register'){
            header('location: /proyecto/starting/'.$p);
            exit;
        }
        $estaLogueado = isset($_SESSION['logueado']) && $_SESSION['logueado'] === 1;
        if((!$estaLogueado) && $p !== "starting" && $p !== "terminos"){
            header('location: /proyecto/starting');
            exit;
        }elseif($estaLogueado && $p === "starting"){
            header('location: /proyecto/inicio');
            exit;
        }
        return $p;
    }
}
