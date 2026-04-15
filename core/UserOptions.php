<?php
class UserOptions{
    private $con;
    public function __construct($con){
        $this->con = $con;
    }
    public function obtenerUrl($urlCorta){
        $stmt = $this->con->prepare("SELECT UrlLarga FROM urlscortas WHERE UrlCorta = ?");
        $stmt->bind_param('s', $urlCorta);
        $stmt->execute();
        $result1 = $stmt->get_result();
        $stmt = $this->con->prepare("UPDATE urlscortas SET Visitas = Visitas + 1 WHERE UrlCorta = ?");
        $stmt->bind_param('s', $urlCorta);
        $stmt->execute();
        return $result1->fetch_assoc();
    }
    public function obtenerUrls($idUser){
        $stmt = $this->con->prepare("SELECT * FROM urlscortas WHERE IdUser = ?");
        $stmt->bind_param('i', $idUser);
        $stmt->execute();
        $result1 = $stmt->get_result();
        return $result1->fetch_all(MYSQLI_ASSOC);
    }
    public function crearUrl($urlLarga, $nombre, $idUser){
        $urlCorta = substr(md5($urlLarga.time()), 0, 6);
        // verificar si existe la url corta
        $comprobarSiExisteUrl = $this->con->prepare("SELECT * FROM urlscortas WHERE UrlCorta = ?");
        $comprobarSiExisteUrl->bind_param('s', $urlCorta);
        $comprobarSiExisteUrl->execute();
        $result1 = $comprobarSiExisteUrl->get_result();
        if($result1->num_rows > 0){
            return false;
        }
        // comprobar si efectivamente es una url UrlLarga https o http
        if(!preg_match('/^(https?:\/\/|www\.).+$/', $urlLarga)){
            return false;
        }
        // comprobar si el nombre es valido
        if(!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $nombre)){
            return false;
        }
        // comprobar si el nombre no es una url
        if(preg_match('/^(https?:\/\/|www\.).+$/', $nombre)){
            return false;
        }

        $stmt = $this->con->prepare("INSERT INTO urlscortas (NombreUrl, UrlCorta, UrlLarga, IdUser) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('sssi', $nombre, $urlCorta, $urlLarga, $idUser);
        $stmt->execute();
        return $urlCorta;
    }
    public function eliminarUrl($urlCorta, $idUser){
        $stmt = $this->con->prepare("SELECT * FROM urlscortas WHERE UrlCorta = ? AND IdUser = ?");
        $stmt->bind_param('si', $urlCorta, $idUser);
        $stmt->execute();
        $result1 = $stmt->get_result();
        if($result1->num_rows === 0){
            return false;
        }
        $stmt = $this->con->prepare("DELETE FROM urlscortas WHERE UrlCorta = ? AND IdUser = ?");
        $stmt->bind_param('si', $urlCorta, $idUser);
        $stmt->execute();
        return $result1->fetch_assoc();
    }
    
}