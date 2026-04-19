function mostrarRegister() {
    toggleLoader(true, '.starting');
    document.querySelector('.form-right').classList.remove('active');
    document.getElementById('cardStarting').classList.remove('move-left');
    document.getElementById('cardStarting').classList.add('move-right');
    document.querySelector('.form-left').classList.add('active');
    document.querySelector('.login-button').disabled = false;
    document.querySelector('.register-button').disabled = true;
    toggleLoader(false, '.starting');
}

function mostrarLogin() {
    toggleLoader(true, '.starting');
    document.querySelector('.form-left').classList.remove('active');
    document.getElementById('cardStarting').classList.remove('move-right');
    document.getElementById('cardStarting').classList.add('move-left');
    document.querySelector('.form-right').classList.add('active');
    document.querySelector('.register-button').disabled = false;
    document.querySelector('.login-button').disabled = true;
    toggleLoader(false, '.starting');
}