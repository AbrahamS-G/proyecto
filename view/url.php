<?php
$parametro = isset($_GET['parametros'][0]) ? $_GET['parametros'][0] : null;
$urlencontrada = false;
if ($parametro !== null) {
    if (isset($data['url']['UrlLarga'])) {
        // Caso: Existe y se encontró -> Redirigir
        header("Location: " . $data['url']['UrlLarga']);
        exit();
    } else {
        // Caso: Existe pero NO se encontró -> Mostrar error y detener
        ?>
        <link rel="stylesheet" href="./assets/css/url.css">
        <div class="error-container">
            <h1>404 - Enlace no encontrado</h1>
            <p>Lo sentimos, la URL corta <strong>"<?= htmlspecialchars($parametro) ?>"</strong> no existe o ha sido eliminada.</p>
            <a href="/proyecto/url" class="btn-menu">Volver al inicio</a>
        </div>
        <script>
            ocultarLoader();
        </script>
        <?php
        $urlnoencontrada = true;
    }
}
if(!isset($urlnoencontrada)){
    ?>
    <link rel="stylesheet" href="./assets/css/url.css">
    <h2>Acortador de URLs</h2>
    <div class="creadorUrl">
        <form action="/proyecto/url" method="post">
        <h2>Acortar una URL</h2>
        <input type="text" name="nombre" placeholder="Ingresa el nombre de la URL" id="NombreUrl" autocomplete="off">
        <input type="text" name="url" placeholder="Ingresa la URL a acortar" id="UrlLarga" autocomplete="off">
        <button class="btn-menu" type="button">Crear</button>
    </form>
    <b id="mensajeUrl"></b>
</div>
<div class="misUrls">
    <h2>Mis URLs</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nombre</th>
                <th>URL Corta</th>
                <th>URL Larga</th>
                <th>Visitas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(count($data['urls']) == 0){
                ?>
                <tr>
                    <td colspan="6">No hay URLs</td>
                </tr>
                <?php
            }else{
                $count = 1; 
                foreach($data['urls'] as $url): ?>
                    <tr id="url<?=$url['UrlCorta']?>">
                        <td><?=$count++?></td>
                        <td><?=$url['NombreUrl']?></td>
                    <td><a href="./url/<?=$url['UrlCorta']?>" target="_blank"><?=$url['UrlCorta']?></a></td>
                    <td><a href="<?=$url['UrlLarga']?>" target="_blank"><?=$url['UrlLarga']?></a></td>
                    <td><?=$url['Visitas']?></td>
                    <td>
                        <button class="btn-menu" onclick="copiarLink(this, '<?= $_SERVER['HTTP_HOST'] ?>/proyecto/url/<?=$url['UrlCorta']?>')">Copiar</button>
                        <button class="btn-menu" onclick="eliminarUrl(this, '<?=$url['UrlCorta']?>')">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; 
            }?>
        </tbody>
    </table>
</div>
<script src="./assets/js/url.js"></script>
    <?php
}