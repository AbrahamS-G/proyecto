<div class="error-page">
    <h1>404 ;(</h1>
    <div class="loader"></div>
    <p>Página no encontrada</p>
    <p>La página que buscas no existe o fue movida.</p>
    <button onclick="cargarPagina('./inicio', true, 'Inicio')">Ir al inicio</button>
</div>
<style>
    .error-page {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        text-align: center;
        user-select: none;
    }
    .error-page h1 {
        font-size: 10rem;
        margin-bottom: 1rem;
    }
    .error-page p {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    .error-page button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #363a4d;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }
    .error-page button:hover {
        background-color: #545a7f;
    }
</style>