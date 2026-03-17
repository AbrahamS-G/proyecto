<nav id="menu">
    <ul>
        <li onclick="cargarPagina('./inicio',true,'Inicio')"><img src="./assets/img/default/inicio.svg" alt="">Inicio</li>
        <li onclick="cargarPagina('./dashboard',true,'Dashboard')"><img src="./assets/img/default/dashboard.svg" alt="">Dashboard</li>
        <!-- <li onclick="cargarPagina('./starting',true,'Starting')"><img src="./assets/img/default/starting.svg" alt="">Starting</li> -->
        <li onclick="cargarPagina('./info',true,'Información')"><img src="./assets/img/default/info.svg" alt="">Información</li>
        <li onclick="cargarPagina('./laboratorio',true,'Laboratorio')"><img src="./assets/img/default/lab.svg" alt="">Laboratorio</li>
        <li onclick="cargarPagina('./logout',true,'Cerrar Sesión')"><img src="./assets/img/default/logout.svg" alt="">Cerrar Sesión</li>
        <button onclick="cargarPagina('./url/123',true,'URL')" class="btn-menu">Ir a Cuidados</button>
    </ul>
    <div class="ocultar-menu" onclick="ocultarMenu()">
        <img src="./assets/img/default/flecha_arriba.svg" alt="">
    </div>
</nav>
<link rel="stylesheet" href="./assets/css/menu.css">
<script src="./assets/js/menu.js"></script>
<script>
    function ocultarMenu(){
        const menu = document.getElementById('menu');
        menu.classList.remove('active');
        menu.classList.add('inactive');
    }
</script>
<style>
    .ocultar-menu{
        display: flex;
        cursor: pointer;
        border: none;
        background: #7880b3;
        color: white;
        font-size: 16px;
        width: fit-content;
        padding: 10px;
        align-items: center;
        margin-left: auto;
    }
    .ocultar-menu:hover{
        background: #5a618f;
    }
</style>