<header class="headerGlobal">
    <h1 class="titulo">Proyecto</h1>
    <?php
    if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == 1){
    ?>
    <details class="menuPerfil" id="menuPerfilHeader">
        <summary>
            <?php
            $nombre = $_SESSION['datos']['nombre'];
            echo "<b>$nombre</b>";
            ?>
        </summary>
        <ul>
            <li onclick="cargarPagina('./perfil',true,'Perfil')"><img src="./assets/img/default/perfil.svg" alt="">Perfil</li>
            <li onclick="cargarPagina('./info',true,'Información')"><img src="./assets/img/default/info.svg" alt="">Información</li>
            <li onclick="cargarPagina('./logout',true,'Cerrar Sesión')"><img src="./assets/img/default/logout.svg" alt="">Cerrar sesión</li>
        </ul>
    </details>
    <?php
    }
    ?>
</header>