function cargarPagina(url, saveHistory = true, titulo = "") {
    mostrarLoader(500);
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
                document.getElementById('menu').classList.remove('active');
                if (saveHistory) {
                    window.history.pushState({}, '', url);
                }
                ejecutarScripts(contenedor);
            }
        })
        .catch(error => {
            console.error(error);
        });
}
function mostrarLoader(segundos = 2000) {
    const loader = document.getElementById('loader');
    if (loader) {
        loader.style.display = 'flex';
        setTimeout(function () {
            loader.style.display = 'none';
        }, segundos);
    }
}
document.addEventListener('submit', e => {
    const form = e.target;
    if (form.method.toLowerCase() === 'post') {
        e.preventDefault();

        const formData = new FormData(form);
        const url = form.getAttribute('action') || window.location.pathname;
        cargarPagina(url);

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