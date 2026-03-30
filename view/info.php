<h2>Información</h2>
<?php 
if(isset($_SESSION)){
    echo "la sesion esta iniciada";
    print_r($_SESSION);
    echo "La cuenta tiene Estado ".$_SESSION['datos']['estado'];
    if($_SESSION['datos']['estado'] == 1){
        echo "La cuenta esta activa";
    }else if($_SESSION['datos']['estado'] == 2){
        echo "La cuenta esta suspendida";
    }else if($_SESSION['datos']['estado'] == 3){
        echo "La cuenta esta bloqueada";
    }
}else{
    echo "la sesion no esta iniciada";
}