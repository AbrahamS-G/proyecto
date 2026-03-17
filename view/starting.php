<link rel="stylesheet" href="./assets/css/starting.css">
<div class="starting starting-wrapper">
    <div class="forms-container">
        <div class="formFormat form-left">
            <?php include '../view/login.php'; ?>
        </div>
        <div class="formFormat form-right">
            <?php include '../view/login.php'; ?>
        </div>
    </div>
    <div id="cardStarting" class="card-starting cardStarting">
        <div>
            <h2>Bienvend@</h2>
            Este es un espacio de proyectos, pruebas y errores, donde se busca mejorar y aprender. <br>
            <small>Si ya tienes una cuenta, inicia sesión. Si no, pulsa el botón de comenzar.</small>
        </div>
        <ul>
            <h2>¿Qué encontrarás aquí?</h2>
            <li>Sistema de ahorros y gastos personalizado con metricas y estadisticas.</li>
            <li>Sistema de calendarización de eventos o recordatorios.</li>
            <li>Un acortador de URLs personalizado.</li>
            <li>Organizador de tareas y proyectos.</li>
            <li>Notificaciones personalizadas.</li>
            <li>Laboratorio de pruebas.</li>
            <li>Sistema de logs.</li>
            <li>Modulos AJAX.</li>
        </ul>
        <div class="buttons">
            <button onclick="cargarPagina('./starting/login', true, 'Login')" class="btn-menu login login-button">
            Iniciar Sesión
            </button>
            <button onclick="cargarPagina('./starting/register', true, 'Register')" class="btn-menu register register-button">
            Comenzar
            </button>
            <?php if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == 1){
                echo "<button onclick='cargarPagina(\"./inicio\", true, \"Inicio\")' class='btn-menu'>
                Ir a Inicio
                </button>";
            } ?>
        </div>
    </div>
    <?php include_once '../view/login.php'; ?>
</div>
<?php 
$parametro = isset($_GET['parametros'][0]) && !empty($_GET['parametros'][0]) ? $_GET['parametros'][0] : '';
$parametro2 = isset($_GET['parametros'][1]) && !empty($_GET['parametros'][1]) ? $_GET['parametros'][1] : '';
if($parametro == ''){
    ?>
    <script>
    document.querySelector('.login-button').disabled = true;
    </script>
    <?php
}
if($parametro === 'register'){
    ?>
    <script>
    // mostrar loader por 2 segundos
    document.getElementById('loader').style.display = 'flex';
    document.getElementById('cardStarting').classList.add('move-right');
    document.getElementById('cardStarting').classList.remove('move-left');
    document.querySelector('.register-button').disabled = true;
    document.querySelector('.login-button').disabled = false;
    mostrarLoader(2000);
    </script> <?php
}else if($parametro === 'login'){
    ?>
    <script>
    document.getElementById('loader').style.display = 'flex';
    document.getElementById('cardStarting').classList.remove('move-right');
    document.getElementById('cardStarting').classList.add('move-left');
    document.querySelector('.register-button').disabled = false;
    document.querySelector('.login-button').disabled = true;
    mostrarLoader(2000);
    </script>
<?php }
if($parametro2 == 'true'){
    $_SESSION['logueado'] = 1;
}
?>