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
    document.querySelectorAll('#menu ul li').forEach(li => {
        li.setAttribute('title', li.querySelector('span').textContent);
    });
    if (document.getElementById('ocultar-menu')) {
        document.getElementById('ocultar-menu').onclick = mostrarMenu;
    }
    localStorage.setItem('menu', 'oculto');
}

function mostrarMenu() {
    document.body.classList.remove('inactive');
    document.body.classList.add('active');
    document.querySelectorAll('#menu ul li').forEach(li => {
        li.removeAttribute('title');
    });
    if (document.getElementById('ocultar-menu')) {
        document.getElementById('ocultar-menu').onclick = ocultarMenu;
    }
    localStorage.setItem('menu', 'visible');
}

inicializarMenu();