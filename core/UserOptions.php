<?php
class UserOptions{
    private $con;
    public function __construct($con){
        $this->con = $con;
    }
    public function obtenerUrl($urlCorta){
        $stmt = $this->con->prepare("SELECT * FROM urlscortas WHERE UrlCorta = ?");
        $stmt->bind_param('s', $urlCorta);
        $stmt->execute();
        $result1 = $stmt->get_result();
        $stmt = $this->con->prepare("UPDATE urlscortas SET Visitas = Visitas + 1 WHERE UrlCorta = ?");
        $stmt->bind_param('s', $urlCorta);
        $stmt->execute();
        return $result1->fetch_assoc();
    }
    public function crearUrl($urlLarga, $idUser){
        $urlCorta = substr(md5($urlLarga.time()), 0, 6);
        $stmt = $this->con->prepare("INSERT INTO urlscortas (UrlCorta, UrlLarga, IdUser) VALUES (?, ?, ?)");
        $stmt->bind_param('ssi', $urlCorta, $urlLarga, $idUser);
        $stmt->execute();
        return $urlCorta;
    }
    public function obtenerUrls($idUser){
        $stmt = $this->con->prepare("SELECT * FROM urlscortas WHERE IdUser = ?");
        $stmt->bind_param('i', $idUser);
        $stmt->execute();
        $result1 = $stmt->get_result();
        return $result1->fetch_all(MYSQLI_ASSOC);
    }
    public function login($usuario, $clave){
        $stmt = $this->con->prepare("SELECT IdUser, Usuario, Clave, Nombre FROM usuarios WHERE Usuario = ?");
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $result1 = $stmt->get_result();
        $user = $result1->fetch_assoc();
        if($user && password_verify($clave, $user['Clave'])){
            return $user;
        }
        return null;
    }
}