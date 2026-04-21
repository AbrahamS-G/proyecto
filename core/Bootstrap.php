<?php
class Bootstrap{
    public static function init(){
        date_default_timezone_set('America/Mexico_City');
        define("PROYECTO_VERSION", "BETA 0.0.4.11");
        session_name("PROYECTO");

        spl_autoload_register(function ($class) {
            require_once __DIR__ . '/' . $class . '.php';
        });
        $con = Database::connect();
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        ob_start();

        return $con;
    }
}