

document.addEventListener('DOMContentLoaded', function() {
    const alert = document.querySelector('.alert-dismissible');
    if (alert) {
        setTimeout(() => {
            // Quitar clase 'show' para iniciar la transición
            alert.classList.remove('show');
            
            // Esperar la transición de Bootstrap (0.15s por defecto) antes de remover del DOM
            setTimeout(() => {
                alert.remove();
            }, 150); 
        }, 5000);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const botonesVer = document.querySelectorAll('.btn-ver');
    const modal = new bootstrap.Modal(document.getElementById('verAlumnoModal'));

    botonesVer.forEach(boton => {
        boton.addEventListener('click', () => {
            document.getElementById('modal-cedula').textContent = boton.getAttribute('data-cedula');
            document.getElementById('modal-nombres').textContent = boton.getAttribute('data-nombres');
            document.getElementById('modal-apellidos').textContent = boton.getAttribute('data-apellidos');
            document.getElementById('modal-correo').textContent = boton.getAttribute('data-correo');
            document.getElementById('modal-telefono').textContent = boton.getAttribute('data-telefono');
            document.getElementById('modal-fecha').textContent = boton.getAttribute('data-fecha');

            modal.show();
        });
    });
});


