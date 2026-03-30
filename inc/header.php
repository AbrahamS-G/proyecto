<header>
    <h1 class="titulo">Proyecto</h1>
    <?php
    if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == 1){
    ?>
    <details>
        <summary>
            <?php
            $nombre = $_SESSION['datos']['nombre'];
            echo "<b>$nombre</b>";
            ?>
        </summary>
        <ul>
            <li><a href="#">Perfil</a></li>
            <li><a href="#">Cerrar sesión</a></li>
        </ul>
    </details>
    <?php
    }
    ?>
</header>