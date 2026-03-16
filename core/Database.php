<?php 
class Database {
    public static function connect(){
        $config = require __DIR__ . "/../config/database.php";
        $con = new mysqli($config['host'],$config['user'],$config['password'],$config['db']);
        if($con -> connect_error){
            die("Error de conexión". $con -> connect_error);
        }
        $con->set_charset("utf8mb4");
        return $con;
    }
}
