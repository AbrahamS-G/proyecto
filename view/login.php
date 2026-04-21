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
        <small>Al acceder a este sitio aceptas los <a href="javascript:void(0)" onclick="cargarPagina('terminos',true,'Terminos y Condiciones')">Terminos y Condiciones</a></small>
    </form>
</div>
<script>
    const btnIniciarSesion = document.querySelector('.btnIniciarSesion');
    // al mandar el formulario, deshabilitar el boton hasta recibir respuesta para evitar duplicidad
    btnIniciarSesion.addEventListener('click', function(e) {
        e.preventDefault();
        btnIniciarSesion.disabled = true;
        const form = document.querySelector('#login form');
        const formData = new FormData(form);
        fetch('/proyecto/api/login.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if(data.success && data.id){
                    // cargarPagina('./inicio',true, 'Inicio');
                    if(data.requireMenu){
                        fetch('./inicio', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(() => {
                            location.reload();
                        });
                    }
                    const header = document.querySelector('.headerGlobal');
                    if (header && !header.querySelector('.menuPerfil')) {
                        const detailsHTML = `
                            <details class="menuPerfil" id="menuPerfilHeader">
                                <summary>
                                    <b>${data.nombre}</b>
                                </summary>
                                <ul>
                                    <li onclick="cargarPagina('./perfil',true,'Perfil')"><img src="./assets/img/default/perfil.svg" alt="">Perfil</li>
                                    <li onclick="cargarPagina('./info',true,'Información')"><img src="./assets/img/default/info.svg" alt="">Información</li>
                                    <li onclick="cargarPagina('./logout',true,'Cerrar Sesión')"><img src="./assets/img/default/logout.svg" alt="">Cerrar sesión</li>
                                </ul>
                            </details>
                        `;
                        header.insertAdjacentHTML('beforeend', detailsHTML);
                    } else if (header) {
                        const summaryB = header.querySelector('.menuPerfil summary b');
                        if (summaryB) summaryB.textContent = data.nombre;
                    }
                }else{
                    crearToast('Error', '', data.message, 'error');
                    btnIniciarSesion.disabled = false;
                }
            });
    });
</script>