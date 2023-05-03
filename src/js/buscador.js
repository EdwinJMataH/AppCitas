
const fechaInput = document.getElementById('fecha_cita');

fechaInput.addEventListener('input', function(e) {
    const fecha = e.target.value;
    window.location = `?fecha=${fecha}`
})