<?php
$opcionesMenu = [
    ['id' => 'inicio', 'titulo' => 'Inicio', 'icono' => './assets/img/default/inicio.svg'],
    ['id' => 'dashboard', 'titulo' => 'Dashboard', 'icono' => './assets/img/default/dashboard.svg'],
    ['id' => 'finanzas', 'titulo' => 'Finanzas', 'icono' => './assets/img/default/finanzas.svg'],
    ['id' => 'laboratorio', 'titulo' => 'Laboratorio', 'icono' => './assets/img/default/lab.svg'],
    ['id' => 'url', 'titulo' => 'Acortador', 'icono' => './assets/img/default/link.svg'],
    ['id' => 'soporte', 'titulo' => 'Soporte', 'icono' => './assets/img/default/soporte.svg']
];
?>
<nav id="menu">
    <ul>
        <?php foreach ($opcionesMenu as $opcion) : ?>
            <li onclick="cargarPagina('./<?= $opcion['id']; ?>',true,'<?= $opcion['titulo']; ?>')"><img src="<?= $opcion['icono']; ?>" alt="<?= $opcion['titulo']; ?>"><span><?= $opcion['titulo']; ?></span></li>
        <?php endforeach; ?>
    </ul>
    <div class="opciones-extra">
        <div class="ocultar-menu" id="ocultar-menu" onclick="ocultarMenu()" title="Ocultar menú">
            <img src="./assets/img/default/flecha_arriba.svg" alt="">
        </div>
    </div>
</nav>