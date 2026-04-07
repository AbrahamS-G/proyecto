function copiarLink(btn, url) {
    const textoCompleto = window.location.protocol + "//" + url;

    // Intento con la API moderna
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(textoCompleto)
            .then(() => darFeedback(btn))
            .catch(err => console.error('Error:', err));
    } else {
        const textArea = document.createElement("textarea");
        textArea.value = textoCompleto;

        // Asegurar que no se vea el textarea
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "0";
        document.body.appendChild(textArea);

        textArea.focus();
        textArea.select();

        try {
            document.execCommand('copy');
            darFeedback(btn);
        } catch (err) {
            console.error('Fallback error:', err);
        }

        document.body.removeChild(textArea);
    }
}

// Función auxiliar para el cambio de texto
function darFeedback(btn) {
    const originalText = btn.innerHTML;
    btn.innerHTML = "Copiado";
    btn.classList.add('copiado'); // Opcional por si quieres darle estilo CSS

    setTimeout(() => {
        btn.innerHTML = originalText;
        btn.classList.remove('copiado');
    }, 2000);
}
function eliminarUrl(btn, url) {
    const formData = new FormData();
    formData.append('url', url);
    formData.append('eliminar', true);
    fetch('./public/api/url.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                crearToast('Exito', '', data.message, 'exito');
                cargarPagina('./url', false, 'Urls');
            } else {
                crearToast('Error', '', data.message, 'error');
            }

        }).catch(error => {
            crearToast('Error', '', error.message, 'error');
        });
}
// ajax de url mandarlo a /api/url con post
document.querySelector('.creadorUrl form button').addEventListener('click', function (e) {
    const formData = new FormData(document.querySelector('.creadorUrl form'));
    fetch('./public/api/url.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.url) {
                console.log(data.url)
                const url = window.location.hostname + '/proyecto/url/' + data.url;
                copiarLink(this, url);
                console.log(url);
                crearToast('Exito', '', 'URL acortada creada y copiada con exito', 'exito');
                cargarPagina('./url', false, 'Urls');
            } else {
                crearToast('Error', '', data.message, 'error');
            }

        }).catch(error => {
            crearToast('Error', '', error.message, 'error');
        });
});