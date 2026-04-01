<h2>Información</h2>
<?php 
print_r($_SESSION);
switch($_SESSION['datos']['estado']){
    case 1:
        echo "La cuenta esta activa";
        break;
    case 2:
        echo "La cuenta esta suspendida";
        break;
    case 3:
        echo "La cuenta esta bloqueada";
        break;
}