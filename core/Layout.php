<?php 
class Layout{
    public static function render($p,$auth, $data = []){
        extract($data);
        $esAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        if(isset($_SESSION['datos']['estado']) && ($_SESSION['datos']['estado'] !== 'activo')){
            ?>
            <link rel="stylesheet" href="./assets/css/estadoCuenta.css">
            <div id="EstadoCuenta">
                <div class="container">
                    <p>Tu cuenta esta suspendida o bloqueada</p>
                    <button onclick="window.location.href = './logout';">Cerrar sesión</button>
                    <button onclick="window.location.reload();">Recargar página</button>
                    <small>Si crees que es un error, por favor contacta al administrador</small>
                </div>
            </div>
        <?php 
            $auth->validar();
            exit; 
        }
        if (!$esAjax) {
            include('../inc/header.php');
            if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == 1){
                include('../inc/menu.php');
            }
            $globalCss = ['index','menu','toast','loader'];
            $globalJs = ['main','menu','toast'];
            foreach($globalCss as $css){
                echo '<link rel="stylesheet" href="./assets/css/'.$css.'.css">';
            }
            foreach($globalJs as $js){
                echo '<script src="./assets/js/'.$js.'.js"></script>';
            }
            ?>
            <main class="main" id="main">
            <?php } 
            $assets = self::getAssets($p);
            foreach($assets['css'] as $css){
                echo '<link rel="stylesheet" href="./assets/css/'.$css.'.css">';
            }
            if(is_file('../view/'.$p.'.php')){
                    include('../view/'.$p.'.php');
                }else{
                    include('../view/404.php');
                }
            foreach($assets['js'] as $js){
                echo '<script src="./assets/js/'.$js.'.js"></script>';
            }
            if (!$esAjax) {
                echo "</main>";
                include('../inc/footer.php');
        }
        if (!empty($_SESSION['toast'])) {
            $toasts = is_array($_SESSION['toast'][0])
                ? $_SESSION['toast']
                : [$_SESSION['toast']];
            echo "<script>";
            foreach ($toasts as $toast){
                list($titulo, $link, $texto, $tipo, $color, $fondo) = array_pad($toast, 6, '');
            echo "crearToast("
                . json_encode($titulo) . ","
                . json_encode($link) . ","
                . json_encode($texto) . ","
                . json_encode($tipo) . ","
                . json_encode($color) . ","
                . json_encode($fondo) . ");";
            }
            echo "</script>";
            unset($_SESSION['toast']);
        }
    }
    private static function getAssets($p){
        $mapa = [
            'starting' => ['css' => ['starting','login'], 'js' => ['starting']],
            'url' => ['css' => ['url'], 'js' => ['url']],
            'inicio' => ['css' => ['inicio'], 'js' => ['inicio']],
        ];
        return $mapa[$p] ?? ['css' => [], 'js' => []];
    }
}
