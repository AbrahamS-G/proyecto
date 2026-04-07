<header class="headerGlobal">
    <h1 class="titulo">Proyecto</h1>
    <?php
    if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == 1){
    ?>
    <details class="menuPerfil">
        <summary>
            <?php
            $nombre = $_SESSION['datos']['nombre'];
            echo "<b>$nombre</b>";
            ?>
        </summary>
        <ul>
            <li><a href="#">Perfil</a></li>
            <li><a href="#">Cerrar sesión</a></li>
            <li><a href="">Este es el header</a></li>
        </ul>
    </details>
    <?php
    }
    ?>
</header>