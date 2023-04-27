// Obtener el formulario y el campo de búsqueda
const myForm = document.getElementById('myForm');
const searchInput = document.getElementById('query');

// Escuchar el evento 'keyup' en el campo de búsqueda
searchInput.addEventListener('keyup', function (event) {
    if (searchInput.value.trim() !== '') {
        myForm.submit(); // Enviar el formulario
    }
});