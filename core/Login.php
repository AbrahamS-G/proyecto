<?php
class Login{
    private $con;
    public function __construct($con){
        $this->con = $con;
    }
    public function log($usuario, $clave){
        $stmt = $this->con->prepare("SELECT IdUser, Usuario, Clave, Nombre FROM usuarios WHERE Usuario = ?");
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $result1 = $stmt->get_result();
        $user = $result1->fetch_assoc();
        if($user && password_verify($clave, $user['Clave'])){
            date_default_timezone_set('America/Mexico_City');
            $token = bin2hex(random_bytes(32));
            setcookie('proyectoToken', $token, time() + 60 * 60 * 24 * 7, '/'); // 1 semana
            $_SESSION['logueado'] = 1;
            $_SESSION['datos'] = [
                'id' => $user['IdUser'],
                'usuario' => $user['Usuario'],
                'nombre' => $user['Nombre'],
            ];
            $datosSesion = [
                'IdUser' => $user['IdUser'],
                'Token' => $token,
                'NombreDispositivo' => $_SERVER['HTTP_USER_AGENT'],
                'IP' => $_SERVER['REMOTE_ADDR'],
                'UA' => $_SERVER['HTTP_USER_AGENT'],
                'UltimaActividad' => date('Y-m-d H:i:s'),
                'ExpiraEn' => date('Y-m-d H:i:s', strtotime('+7 days')),
                'EstaActivo' => 1,
                'FechaCreada' => date('Y-m-d H:i:s')
            ];
            $stmt = $this->con->prepare("INSERT INTO sesiones (IdUser, Token, NombreDispositivo, IP, UA, UltimaActividad, ExpiraEn, EstaActivo, FechaCreada) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('issssssss', $user['IdUser'], $datosSesion['Token'], $datosSesion['NombreDispositivo'], $datosSesion['IP'], $datosSesion['UA'], $datosSesion['UltimaActividad'], $datosSesion['ExpiraEn'], $datosSesion['EstaActivo'], $datosSesion['FechaCreada']);
            $stmt->execute();
            return [...$user, 'success' => true];
        }else{
            $_SESSION['logueado'] = 0;
            return ['success' => false];
        }
    }
    public function logout(){
        $token = $_COOKIE['proyectoToken'] ?? null;
        if($token){
            $stmt = $this->con->prepare("DELETE FROM sesiones WHERE Token = ?");
            $stmt->bind_param('s', $token);
            $stmt->execute();
        }
        setcookie('proyectoToken', '', time() - 3600, '/');
        session_destroy();
        session_start();
        $_SESSION['toast'] = ['Exito','','Saliste exitosamente','exito'];
        echo '<script>window.location.href = "./starting";</script>';
        exit;
    }
}