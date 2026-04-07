<nav id="menu">
    <ul>
        <li onclick="cargarPagina('./inicio',true,'Inicio')"><img src="./assets/img/default/inicio.svg" alt="Inicio"><span>Inicio</span></li>
        <li onclick="cargarPagina('./dashboard',true,'Dashboard')"><img src="./assets/img/default/dashboard.svg" alt="Dashboard"><span>Dashboard</span></li>
        <li onclick="cargarPagina('./finanzas',true,'Finanzas')"><img src="./assets/img/default/finanzas.svg" alt="Finanzas"><span>Finanzas</span></li>
        <li onclick="cargarPagina('./info',true,'Información')"><img src="./assets/img/default/info.svg" alt="Información"><span>Información</span></li>
        <li onclick="cargarPagina('./laboratorio',true,'Laboratorio')"><img src="./assets/img/default/lab.svg" alt="Laboratorio"><span>Laboratorio</span></li>
        <li onclick="cargarPagina('./url',true,'Acortador')"><img src="./assets/img/default/link.svg" alt="Acortador de URLs"><span>Acortador de URLs</span></li>
    </ul>
    <div class="opciones-extra">
        <button onclick="cargarPagina('./logout',true,'Cerrar Sesión')" class="btn-menu"><img src="./assets/img/default/logout.svg" alt="">Cerrar Sesión</button>
        <div class="ocultar-menu" onclick="ocultarMenu()" title="Ocultar menú">
            <img src="./assets/img/default/flecha_arriba.svg" alt="">
        </div>
    </div>
</nav>