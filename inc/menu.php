<nav id="menu">
    <ul>
        <li><a href="./inicio">Inicio</a></li>
        <li><a href="./informacion">Información</a></li>
        <li><a href="./landing">Landing</a></li>
        <li><a href="./logout">Cerrar Sesión</a></li>
    </ul>
</nav>
<link rel="stylesheet" href="./assets/css/menu.css">
<?php 
    if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == 1 && $p !== "landing"){
        echo '<script src="./assets/js/menu.js"></script>';
    }
?>