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
        $idUser = $_SESSION['datos']['id'] ?? null;
        $token = $_COOKIE['proyectoToken'];
        $login = new Login($this->con);

        if(!ctype_xdigit($token)){
            $login->logout();
            return;
        }
        if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == 1){
            date_default_timezone_set('America/Mexico_City');
            $fecha = date('Y-m-d H:i:s');
            $stmt = $this->con->prepare("SELECT u.*, s.Token, s.IdUser FROM usuarios u INNER JOIN sesiones s ON u.IdUser = s.IdUser AND u.IdUser = ? WHERE s.Token = ?");
            $stmt->bind_param('is', $idUser, $cookie);
            $stmt->execute();
            $result1 = $stmt->get_result();
            $user = $result1->fetch_assoc();
            if($user){
                $_SESSION['logueado'] = 1;
                $_SESSION['datos'] = [
                    'id' => $user['IdUser'],
                    'usuario' => $user['Usuario'],
                    'nombre' => $user['Nombre'],
                ];
                $stmt2 = $this->con->prepare("UPDATE sesiones SET UltimaActividad = ? WHERE IdUser = ? AND Token = ?");
                $stmt2->bind_param('ssi', $fecha, $idUser, $cookie);
                $stmt2->execute();
            }else{
                $login->logout();
            }
            return;
        }
    }
}