const boton = document.querySelector('.titulo');
const menu = document.getElementById('menu');

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