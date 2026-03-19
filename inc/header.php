<header>
    <h1 class="titulo">Proyecto</h1>
    <?php
    $nombre = isset($_SESSION['datos']['nombre']) && $_SESSION['logueado'] == 1 ? $_SESSION['datos']['nombre'] : '';
    if($nombre != ''){
        echo "<b>$nombre</b>";
    }
    ?>
</header>