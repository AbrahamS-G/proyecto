<?php

class Autenticador{
    private $con;
    public function __construct($con){
        $this->con = $con;
    }
    public function validar(){
        if(!isset($_COOKIE['proyectoToken']) || empty($_COOKIE['proyectoToken'])){
            return;
        }
        $cookie = $_COOKIE['proyectoToken'] ?? null;
        $login = new Login($this->con);
        if($cookie !== bin2hex(random_bytes(32)) && $cookie == ""){
            $login->logout();
            return;
        }
        session_regenerate_id(true);
        date_default_timezone_set('America/Mexico_City');
        $fecha = date('Y-m-d H:i:s');
        $stmt = $this->con->prepare("SELECT u.*, s.Token, s.IdUser FROM usuarios u INNER JOIN sesiones s ON u.IdUser = s.IdUser WHERE s.Token = ?");
        $stmt->bind_param('s', $cookie);
        $stmt->execute();
        $result1 = $stmt->get_result();
        $user = $result1->fetch_assoc();
        if($user){
            $_SESSION['logueado'] = 1;
            $_SESSION['datos'] = [
                'id' => $user['IdUser'],
                'usuario' => $user['Usuario'],
                'nombre' => $user['Nombre'],
                'estado' => $user['Estado'],
            ];
            $stmt2 = $this->con->prepare("UPDATE sesiones SET UltimaActividad = ? WHERE IdUser = ? AND Token = ?");
            $stmt2->bind_param('ssi', $fecha, $user['IdUser'], $cookie);
            $stmt2->execute();
            return;
        }else{
            $login->logout();
            return;
        }
    }
}