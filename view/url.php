<?php
$parametro = isset($_GET['parametros'][0]) ? $_GET['parametros'][0] : null;
if ($parametro !== null) {
    if (isset($data['url']['UrlLarga'])) {
        header("Location: " . $data['url']['UrlLarga']);
        exit();
    } else { ?>
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
    <h2 class="tituloPagina"><img src="./assets/img/default/link.svg" alt="Acortador"> Acortador</h2>
    <div class="creadorUrl">
        <b id="mensajeUrl"></b>
        <form action="/proyecto/url" method="post">
        <h2>Acortar una URL</h2>
        <input type="text" name="nombre" placeholder="Ingresa el nombre de la URL" id="NombreUrl" autocomplete="off">
        <input type="text" name="url" placeholder="Ingresa la URL a acortar" id="UrlLarga" autocomplete="off">
        <button class="btn-menu" type="button">Crear</button>
    </form>
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
                <th class="acciones-th">Acciones</th>
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
                    <td class="acciones">
                        <div class="buttons">
                            <button class="btn-copiar" onclick="copiarLink(this, '<?= $_SERVER['HTTP_HOST'] ?>/proyecto/url/<?=$url['UrlCorta']?>')"><img src="./assets/img/default/copiar.svg" alt="Copiar">Copiar</button>
                            <button class="btn-eliminar" onclick="eliminarUrl(this, '<?=$url['UrlCorta']?>')"><img src="./assets/img/default/borrar.svg" alt="Borrar">Eliminar</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; 
            }?>
        </tbody>
    </table>
</div>
    <?php
}