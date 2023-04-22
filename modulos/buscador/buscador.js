// Obtener el input de búsqueda
const searchInput = document.getElementById('busqueda');
// Escuchar el evento 'input' en el input de búsqueda
searchInput.addEventListener('input', () => {
    // Obtener el valor del input de búsqueda
    const searchValue = searchInput.value;
    // Realizar una petición AJAX al servidor para obtener los resultados de búsqueda
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../consultas-preparadas/consultas-preparadas.php?q=${searchValue}`);
    // xhr.open('GET', '../tarjetas/tarjetas.php?q=${searchValue}');
    xhr.onload = () => {
        // Actualizar los resultados de búsqueda en la página
        const searchResults = document.getElementById('#container1');
        searchResults.innerHTML = xhr.responseText;
    };
    xhr.send();
})