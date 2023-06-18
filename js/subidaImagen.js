import { createClient } from '../node_modules/@supabase/supabase-js/dist/main/index.js';

const url = 'https://npuxpuelimayqrsmzqur.supabase.co';
const apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU';

const supabase = createClient(url, apiKey);

var formulario = document.getElementById('formularioProducto');
const imageInput = formulario.getElementById('imageInput');

const imageFile = imageInput.files[0]
const fileName = imageFile.name

formulario.addEventListener('submit', function (event) {
    event.preventDefault();
    alert('Subiendo imagen... :10');
    uploadFile(imageFile);
});

async function uploadFile(file) {
    const { data, error } = await supabase
        .storage
        .from('images')
        .upload("public/" + fileName, imageFile, {
            cacheControl: '3600',
            upsert: false
        })
    if (!error) {
        var inputImagen = document.createElement("input");
        inputImagen.type = "hidden";
        inputImagen.name = "imagenes";
        inputImagen.value = imageInput.value;
        formulario.appendChild(inputImagen);

        formulario.submit();
    } else {
        alert('Error al subir la imagen :31')
    }
}
