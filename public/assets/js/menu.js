// proyecto/public/assets/js/menu.js

function inicializarMenu() {
    const boton = document.querySelector('.titulo');
    const menu = document.getElementById('menu');

    if (!boton || !menu) return;

    // Limpiamos eventos previos para no duplicarlos
    boton.removeEventListener('mouseenter', abrirMenu);
    menu.removeEventListener('mouseenter', abrirMenu);
    boton.removeEventListener('mouseleave', intentarCerrar);
    menu.removeEventListener('mouseleave', intentarCerrar);

    let cerrarTimer = null;

    function abrirMenu() {
        clearTimeout(cerrarTimer);
        menu.classList.add('active');
        menu.classList.remove('inactive');
    }

    function intentarCerrar() {
        cerrarTimer = setTimeout(() => {
            const hoverBoton = boton.matches(':hover');
            const hoverMenu = menu.matches(':hover');
            if (!hoverBoton && !hoverMenu) {
                menu.classList.remove('active');
                menu.classList.add('inactive');
            }
        }, 500);
    }

    boton.addEventListener('mouseenter', abrirMenu);
    menu.addEventListener('mouseenter', abrirMenu);
    boton.addEventListener('mouseleave', intentarCerrar);
    menu.addEventListener('mouseleave', intentarCerrar);
}

function ocultarMenu() {
    const menu = document.getElementById('menu');
    menu.classList.remove('active');
    menu.classList.add('inactive');
}

// La ejecutamos la primera vez
inicializarMenu();