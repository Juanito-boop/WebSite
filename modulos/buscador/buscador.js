function buscar() {
    var input = document.getElementById("busqueda");
    var query = input.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "modulos/consultas-preparadas/consultas-preparadas.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("resultados").innerHTML = xhr.responseText;
        }
    };
    xhr.send("query=" + query);
}