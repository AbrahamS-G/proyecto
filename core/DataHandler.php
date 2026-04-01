<?php
class DataHandler{
    private $userOptions;
    public function __construct($con){
        $this->userOptions = new UserOptions($con);
    }
    public function obtenerDatosParaVista($p){
        $data = [
            'url' => [],
            'urls' => [],
            'aumentar' => [],
        ];
        if($p === 'url'){
            if(isset($_GET['parametros'][0]) && !empty($_GET['parametros'][0])){
                $data['url'] = $this->userOptions->obtenerUrl($_GET['parametros'][0]);
            }
            if(isset($_SESSION['datos']['id'])){
                $data['urls'] = $this->userOptions->obtenerUrls($_SESSION['datos']['id']);
            }
        }
        return $data;
    }   
}