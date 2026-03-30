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
        // permitir entrar a url siempre y cuando tenga parametros
        if((!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== 1) && $p !== "starting"){
            if($p == 'url' && isset($_GET['parametros'][0])){
                return $p;
            }
            header('location: /proyecto/starting');
            exit;
        }
        if($p == 'starting' && isset($_COOKIE['proyectoToken'])){
            $auth = new Autenticador($this->con);
            $auth->validar();
            if($_SESSION['logueado'] === 1){
                header('location: /proyecto/inicio');
                exit;
            }
        }elseif($p !== 'starting' && isset($_COOKIE['proyectoToken']) && !isset($_SESSION['logueado']) && $p !== 'url'){
            $auth = new Autenticador($this->con);
            $auth->validar();
            if($_SESSION['logueado'] === 1){
                header('location: /proyecto/'.$p);
                exit;
            }
        }
        return $p;
    }
}
