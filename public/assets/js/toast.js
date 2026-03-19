function crearToast(titulo, link, texto = 'Sin mensaje', tipo = 'info', color = '#F0F9FF', fondo = '#076D9D') {
    const contenedor = document.getElementById('notificacionesToast');
    const notificacion = document.createElement('div');
    notificacion.classList.add('toast');
    const toastsActuales = contenedor.getElementsByClassName('toast');
    if (toastsActuales.length >= 4) {
        toastsActuales[0].remove();
    }

    // Valores por defecto
    if (titulo === '') titulo = "Notificación";

    // Definir ícono según tipo
    let icono = '';
    switch (tipo.toLowerCase()) {
        case 'exito':
            icono = './assets/img/toast/exito.svg';
            notificacion.style.backgroundColor = 'green';
            break;
        case 'error':
            icono = './assets/img/toast/error.svg';
            notificacion.style.backgroundColor = 'red';
            break;
        case 'advertencia':
            icono = './assets/img/toast/advertencia.svg';
            notificacion.style.backgroundColor = '#f39c12';
            break;
        default:
            icono = './assets/img/toast/info.svg';
            notificacion.style.backgroundColor = fondo;
    }

    // Contenido del toast
    const contenido = `
    <div class="toast-content">
        <img class="toast-icon" src="${icono}" alt="${titulo}">
        <div>
            <b class="tituloToast">${titulo}</b>
            <div class="textoToast">${texto}</div>
        </div>
    </div>
`;

    // Si tiene link
    if (link && link !== '') {
        notificacion.style.cursor = 'pointer';
        notificacion.innerHTML = `<a onclick="cargarPagina('${link}', true)" class="link-toast">${contenido}</a>`;
    } else {
        notificacion.innerHTML = contenido;
    }

    // Botón de cerrar
    const cerrarToast = document.createElement('button');
    cerrarToast.classList.add('cerrarBtnToast');
    cerrarToast.innerHTML = 'X';
    cerrarToast.addEventListener('click', () => notificacion.remove());
    notificacion.appendChild(cerrarToast);

    // Mostrar en pantalla
    contenedor.appendChild(notificacion);
    requestAnimationFrame(() => notificacion.classList.add('show'));
    setTimeout(() => notificacion.remove(), 7000);
}