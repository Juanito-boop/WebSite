// Obtener el formulario y el campo de búsqueda
const myForm = document.getElementById('myForm');
const searchInput = document.getElementById('query');

// Escuchar el evento 'submit' en el formulario
myForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevenir el envío automático del formulario
    enviarConsulta(); // Enviar la consulta
});

// Escuchar el evento 'input' en el campo de búsqueda
searchInput.addEventListener('input', function (event) {
    enviarConsulta(); // Enviar la consulta
});

// Función para enviar la consulta usando AJAX
function enviarConsulta() {
    // Si el campo de búsqueda no está vacío, enviar la información usando AJAX
    if (searchInput.value.trim() !== '') {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', './modulos/consultas-preparadas/consultas-preparadas.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log("Respuesta del servidor:", xhr.responseText); // Mostrar la respuesta del servidor en la consola
                // Mostrar el contenido enviado
                console.log("Contenido enviado:", 'query=' + encodeURIComponent(searchInput.value));
            }
        };

        xhr.send('query=' + encodeURIComponent(searchInput.value)); // Enviar la información usando AJAX
    }
}
