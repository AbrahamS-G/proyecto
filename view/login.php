<div id="login">
    <h2>Iniciar Sesión</h2>
    <form action="" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" placeholder="Usuario" autocomplete="off" required>
        <small class="right-small">¿Olvidaste Tú Usuario? <a href="">Pulsa Aquí</a></small>
        <label for="clave">Clave:</label>
        <input type="password" name="clave" id="clave" placeholder="Clave" autocomplete="off" required>
        <small class="right-small">¿Olvidaste Tú Clave? <a href="">Pulsa Aquí</a></small>
        <button type="submit" class="btnIniciarSesion">Iniciar Sesión</button>
        <small>¿Aún no tienes cuenta? <a href="">Pulsa Aquí</a></small>
    </form>
</div>
<link rel="stylesheet" href="./assets/css/login.css">
<script>
    const btnIniciarSesion = document.querySelector('.btnIniciarSesion');
    btnIniciarSesion.addEventListener('click', function(e) {
        e.preventDefault();
        const form = document.querySelector('#login form');
        const formData = new FormData(form);
        fetch('/proyecto/api/login.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    crearToast('Exito', '', data.message, 'exito');
                    cargarPagina('./inicio',true, 'Inicio');
                }else{
                    crearToast('Error', '', data.message, 'error');
                }
            });
    });
</script>