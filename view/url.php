<?php
$parametro = isset($_GET['parametros'][0]) ? $_GET['parametros'][0] : null;
if($data['url'] !== null && !isset($_SESSION['url'])){
    echo "Redirigiendo a: ".$data['url']['UrlLarga'];
    $_SESSION['url'] = $data['url']['UrlLarga'];
    ?>
    <script>
        window.location.href = "/proyecto/url";
    </script>
    <?php
}else{
    if(isset($_SESSION['url'])){
        $url = $_SESSION['url'];
        unset($_SESSION['url']);
        ?>
        <script>
            window.location.href = "<?=$url?>";
        </script>
        <?php
    }else{
        if($data['url'] == null && $parametro !== null){
            ?>
            <div class="creadorUrl">
                <h2>URL no encontrada</h2>
            </div>
            <?php
        }else{  
        ?>
        <div class="creadorUrl">
            <h2>Acortador de URLs</h2>
            <form action="/proyecto/url" method="post">
                <input type="text" name="url" placeholder="Ingresa la URL a acortar" id="UrlLarga" autocomplete="off">
                <button class="btn-menu" type="button">Crear</button>
            </form>
            <b id="mensajeUrl"></b>
        </div>
        <script>
            // ajax de url mandarlo a /api/url con post
            document.querySelector('.creadorUrl form button').addEventListener('click', function(e) {
                const formData = new FormData(document.querySelector('.creadorUrl form'));
                fetch('./public/api/url.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if(data.url){
                        const url = 'http://' + window.location.hostname + '/proyecto/url/' + data.url;
                        document.getElementById('mensajeUrl').innerHTML = `
                            URL acortada:<br>
                            <a href="${url}" target="_blank">${url}</a>
                            <button class="btn-menu" onclick="navigator.clipboard.writeText('${url}'); this.innerHTML = 'Copiado'">Copiar</button>
                        `;
                        document.getElementById('UrlLarga').value = '';
                    }else{
                        document.getElementById('mensajeUrl').innerHTML = `
                            ${data.message}
                        `;
                    }

                }).catch(error => {
                    alert(error.message);
                });
            });
        </script>
        <style>
            .creadorUrl{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
                text-align: center;
                user-select: none;
            }
            .creadorUrl h2{
                font-size: 2rem;
                margin-bottom: 1rem;
            }
            .creadorUrl form{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 1rem;
            }
            .creadorUrl form input{
                padding: 10px 20px;
                border-radius: 5px;
                border: none;
                outline: none;
            }
            .creadorUrl form button{
                padding: 10px 20px;
                background-color: #363a4d;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                border: none;
                cursor: pointer;
            }
            .creadorUrl form button:hover{
                background-color: #545a7f;
            }
            .creadorUrl a{
                color: white;
            }
        </style>
        <?php
        }
    }
}
?>