<div class="starting starting-wrapper">
    <div class="forms-container">
        <div class="formFormat form-left">
            <?php include '../view/register.php'; ?>
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
            <button class="btn-menu login login-button">
            Iniciar Sesión
            </button>
            <button class="btn-menu register register-button">
            Comenzar
            </button>
        </div>
    </div>
</div>
<script>
    document.querySelector('.login-button').addEventListener('click', function() { 
        mostrarLogin();
    });
    document.querySelector('.register-button').addEventListener('click', function() { 
        mostrarRegister();
    });
</script>
<?php 
$parametro = isset($_GET['parametros'][0]) && !empty($_GET['parametros'][0]) ? $_GET['parametros'][0] : 'login';
if($parametro == 'login'){ ?>
    <script>
        mostrarLogin();
    </script>
<?php 
}else if($parametro == 'register'){ ?>
    <script>
        mostrarRegister();
    </script>
<?php 
}
?>