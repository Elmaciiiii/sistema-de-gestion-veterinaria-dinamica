//Boton de cerrar sesion 
// Espera a que el documento esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Obtén el botón de cerrar sesión
    const logoutButton = document.getElementById('logout-button');

    if (logoutButton) {
        logoutButton.addEventListener('click', function(event) {
            event.preventDefault(); // Previene el comportamiento por defecto del enlace

            // Muestra la alerta de confirmación
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Quieres cerrar sesión?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cerrar sesión',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, redirige a index.php
                    window.location.href = logoutButton.href;
                }
                // Si el usuario cancela, no se hace nada
            });
        });
    }
});
