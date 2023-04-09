const searchField = document.getElementById("search");

searchField.addEventListener("input", () => {
    const formData = new FormData(document.getElementById("formulario"));
    const xhr = new XMLHttpRequest();

    xhr.open('POST', document.getElementById("formulario").action, true);
    xhr.onload = function () {
        // Aquí puede manejar la respuesta de la consulta en tiempo real
    };

    xhr.send(formData);
});