<?php 
class Layout{
    public static function render($p,$auth, $userService, $data = []){
        extract($data);
        $esAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        if (!$esAjax) {
            include('../inc/header.php');
            include('../inc/menu.php');
            ?>
            <link rel="stylesheet" href="./assets/css/loader.css">
            <div id="loader">
                <div class="loader"></div>
            </div>
            <main class="main">
                <script src="./assets/js/main.js"></script>
                <script src="./assets/js/toast.js"></script>
            <?php
        }
        if(is_file('../view/'.$p.'.php')){
            include('../view/'.$p.'.php');
        }else{
            if($p == 'login'){
                include('../view/login.php');
            }else{
                include('../view/404.php');
            }
        }
        if (!$esAjax) {
        ?>
        </main>
        <?php
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
}
