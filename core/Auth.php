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
        $cookie = trim(strip_tags(htmlspecialchars($cookie)));
        $login = new Login($this->con);

        $stmt = $this->con->prepare("SELECT u.*, s.Token, s.IdUser FROM usuarios u INNER JOIN sesiones s ON u.IdUser = s.IdUser WHERE s.Token = ? AND s.EstaActivo = 1");
        $stmt->bind_param('s', $cookie);
        $stmt->execute();
        $result1 = $stmt->get_result();
        $user = $result1->fetch_assoc();
        if($user){
            if(session_status() == PHP_SESSION_NONE){ session_start(); }else{ session_regenerate_id(true); }

            $_SESSION['logueado'] = 1;
            $_SESSION['datos'] = [
                'id' => $user['IdUser'],
                'usuario' => $user['Usuario'],
                'nombre' => $user['Nombre'],
                'estado' => $user['Estado'],
            ];

            $fecha = date('Y-m-d H:i:s');
            date_default_timezone_set('America/Mexico_City');
            $stmt2 = $this->con->prepare("UPDATE sesiones SET UltimaActividad = ? WHERE Token = ?");
            $stmt2->bind_param('ss', $fecha, $cookie);
            $stmt2->execute();
        }else{
            $login->logout();
        }
    }
}