document.addEventListener('DOMContentLoaded', function () {
    const btnLogin = document.getElementById('btn-login');
    const btnRegister = document.getElementById('btn-register');
    const modalLogin = document.getElementById('modal-login');
    const modalRegister = document.getElementById('modal-register');
    const closeLogin = document.getElementById('close-login');
    const closeRegister = document.getElementById('close-register');

    if (btnLogin) {
        btnLogin.onclick = function(e) {
            e.preventDefault();
            modalLogin.style.display = 'flex';
        };
    }
    if (btnRegister) {
        btnRegister.onclick = function(e) {
            e.preventDefault();
            modalRegister.style.display = 'flex';
        };
    }
    if (closeLogin) {
        closeLogin.onclick = function() {
            modalLogin.style.display = 'none';
        };
    }
    if (closeRegister) {
        closeRegister.onclick = function() {
            modalRegister.style.display = 'none';
        };
    }
    window.onclick = function(event) {
        if (event.target === modalLogin) {
            modalLogin.style.display = 'none';
        }
        if (event.target === modalRegister) {
            modalRegister.style.display = 'none';
        }
    };
});