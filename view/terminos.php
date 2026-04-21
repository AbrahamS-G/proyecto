<?php
if(!isset($_SESSION['logueado']) || $_SESSION['logueado'] != 1){
?>
<style>
    body {
        grid-template-columns: 0px 1fr !important;
    }
    #menu {
        display: none !important;
    }
    .btn-regresar-login {
        margin-top: 20px;
    }
    #terminos-footer {
        display: none;
    }
</style>
<?php } ?>

<h2 class="tituloPagina">Términos y Condiciones</h2>
<small>Al acceder a este sitio aceptas los términos y condiciones, políticas y avisos de privacidad estipulados a continuación:</small>

<div class="terminos">
    <h3>Condiciones de Uso</h3>
    <ol>
        <li>
            <h4>Uso del Servicio</h4>
            <ol>
                <li>El sitio al que usted tiene acceso es de carácter personal y no comercial.</li>
                <li>Al utilizar el sitio, usted comprende que sus datos están protegidos y se compromete a no realizar acciones que afecten el funcionamiento de los servicios.</li>
                <li>El administrador se reserva el derecho de suspender o eliminar cuentas que violen estas normas sin previo aviso.</li>
                <li>Este sitio es una versión de prueba (<?= PROYECTO_VERSION ?>) y puede contener errores técnicos.</li>
            </ol>
        </li>
        <li>
            <h4>Propiedad Intelectual</h4>
            <ol>
                <li>Todo el código fuente, diseño gráfico y logotipos son propiedad de ABRAHAM_SG, salvo que se indique lo contrario.</li>
                <li>Queda prohibida la reproducción total o parcial del software o la ingeniería inversa de los módulos AJAX y sistemas de gestión integrados.</li>
            </ol>
        </li>
    </ol>

    <br>
    <h3>Política de Privacidad y Cookies</h3>
    <p>Este sitio utiliza cookies técnicas esenciales para su funcionamiento:</p>
    <ul>
        <li><strong>PROYECTO:</strong> Cookie de sesión para mantener la identidad del usuario durante la navegación.</li>
        <li><strong>proyectoToken:</strong> Cookie de persistencia utilizada para la función de "recordar sesión" con una duración de 7 días.</li>
    </ul>
    
    <p>Los datos recopilados (Nombre, Usuario y Correo) se utilizan exclusivamente para la gestión de perfiles y acceso a herramientas personales como el acortador de URLs y el sistema de finanzas.</p>

    <br>
    <h3>Limitación de Responsabilidad</h3>
    <p>El administrador no garantiza la disponibilidad permanente del servicio ni se hace responsable por la pérdida de datos derivados de fallos en la base de datos o mal uso de las credenciales de acceso.</p>

    <?php if(!isset($_SESSION['logueado']) || $_SESSION['logueado'] != 1){ ?>
    <button class="btn-menu btn-regresar-login" onclick="cargarPagina('starting', true, 'Login')">Regresar al Login</button>
    <?php } ?>
</div>