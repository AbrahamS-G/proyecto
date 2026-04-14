function inicializarMenu() {
    if (localStorage.getItem('menu') === 'oculto') {
        ocultarMenu();
    } else {
        mostrarMenu();
    }
}

function ocultarMenu() {
    document.body.classList.remove('active');
    document.body.classList.add('inactive');
    if (document.getElementById('ocultar-menu')) {
        document.getElementById('ocultar-menu').onclick = mostrarMenu;
    }
    localStorage.setItem('menu', 'oculto');
}

function mostrarMenu() {
    document.body.classList.remove('inactive');
    document.body.classList.add('active');
    if (document.getElementById('ocultar-menu')) {
        document.getElementById('ocultar-menu').onclick = ocultarMenu;
    }
    localStorage.setItem('menu', 'visible');
}

inicializarMenu();