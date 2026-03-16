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
}