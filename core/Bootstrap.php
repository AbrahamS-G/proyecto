<?php
class Bootstrap{
    public static function init(){
        date_default_timezone_set('America/Mexico_City');
        define("PROYECTO_VERSION", "BETA 0.0.0.1");
        require_once __DIR__ .'/Database.php';
        $con = Database::connect();

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        ob_start();

        return $con;
    }
}