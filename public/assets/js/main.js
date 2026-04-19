function cargarPagina(url, saveHistory = true, titulo = "") {
    toggleLoader(true, '.main');
    fetch(url, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
        .then(response => {
            if (response.status === 401 || response.status === 403) { window.location.href = './landing'; return; }
            return response.text();
        })
        .then(html => {
            if (!html) return;
            const contenedor = document.querySelector('.main');
            if (contenedor) {
                contenedor.innerHTML = html;
                document.title = titulo !== "" ? titulo + " - Proyecto" : "Proyecto";
                if (saveHistory) {
                    window.history.pushState({}, '', url);
                }
                ejecutarScripts(contenedor);
            }
            toggleLoader(false, '.main');
        })
        .catch(error => {
            toggleLoader(false, '.main');
        });
}
function toggleLoader(show = true, targetSelector = 'body') {
    const target = document.querySelector(targetSelector);
    if (!target) return;

    let loader = target.querySelector('.custom-loader');

    if (show) {
        if (!loader) {
            loader = document.createElement('div');
            loader.className = 'custom-loader';
            loader.innerHTML = '<div class="loader"></div>';
            Object.assign(loader.style, {
                position: 'absolute',
                top: '0',
                left: '0',
                width: '100%',
                height: '100%',
                display: 'flex',
                justifyContent: 'center',
                alignItems: 'center',
                backgroundColor: 'rgba(15, 15, 15, 0.7)',
                zIndex: '1000'
            });
            target.appendChild(loader);
        }
        loader.style.display = 'flex';
    } else {
        if (loader) {
            loader.style.display = 'none';
            loader.remove();
        }
    }
}

// Control de carga inicial de la página
window.addEventListener('load', () => {
    toggleLoader(false);
});
document.addEventListener('submit', e => {
    const form = e.target;
    if (form.method.toLowerCase() === 'post') {
        e.preventDefault();

        const formData = new FormData(form);
        const url = form.getAttribute('action') || window.location.pathname;
        toggleLoader(true);

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(response => {
                if (response.headers.get('X-Update-Menu')) { recargarMenu(); }
                return response.text();
            })
            .then(html => {
                const contenedor = document.querySelector('.main');
                if (contenedor) {
                    contenedor.innerHTML = html;
                    ejecutarScripts(contenedor);
                }
                toggleLoader(false);
            });
    }
});
function ejecutarScripts(contenedor) {
    const scripts = contenedor.querySelectorAll("script");

    scripts.forEach(oldScript => {
        const newScript = document.createElement("script");

        if (oldScript.src) {
            newScript.src = oldScript.src;
        } else {
            newScript.textContent = oldScript.textContent;
        }

        document.body.appendChild(newScript);
        newScript.remove();
    });
}
window.addEventListener('popstate', function () {
    const rutaActual = window.location.pathname.split('/').pop() || 'inicio';
    cargarPagina(rutaActual, false);
});

// Menu perfil header (Delegación de eventos para soportar inserción dinámica tras login)
let timeoutPerfil;
let timeoutClose;

document.addEventListener('mouseover', (e) => {
    const menuPerfilHeader = e.target.closest('#menuPerfilHeader');
    if (menuPerfilHeader) {
        clearTimeout(timeoutPerfil);
        clearTimeout(timeoutClose);
        menuPerfilHeader.setAttribute('open', '');
        setTimeout(() => {
            menuPerfilHeader.classList.add('is-active');
        }, 10);
    }
});

document.addEventListener('mouseout', (e) => {
    const menuPerfilHeader = e.target.closest('#menuPerfilHeader');
    if (menuPerfilHeader) {
        if (!menuPerfilHeader.contains(e.relatedTarget)) {
            timeoutPerfil = setTimeout(() => {
                menuPerfilHeader.classList.remove('is-active');

                timeoutClose = setTimeout(() => {
                    menuPerfilHeader.removeAttribute('open');
                }, 500);
            }, 500);
        }
    }
});