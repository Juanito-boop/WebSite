import { createClient } from '/node_modules/@supabase/supabase-js';

const supabaseUrl = 'https://npuxpuelimayqrsmzqur.supabase.co'
const supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU'
const supabase = createClient(supabaseUrl, supabaseKey)

// var formulario = document.getElementById('formularioProducto');

// formulario.addEventListener('submit', function (event) {
//     event.preventDefault();
//     alert('Subiendo imagen... :10');
//     uploadFile();
// });

// async function uploadFile() {
//     console.log("uyyyyyy");
//     const imageInput = document.getElementById('imageInput')

//     const imageFile = imageInput.files[0]
//     const fileName = imageFile.name

//     const { data, error } = await supabase
//         .storage
//         .from('imagenes-vino')
//         .upload("public/" + fileName, imageFile, {
//             cacheControl: '3600',
//             upsert: false
//         })
//     console.log(data);

//     if (!error) {
//         var inputImagen = document.createElement("input");
//         inputImagen.type = "hidden";
//         inputImagen.name = "imagenes";
//         inputImagen.value = imageInput.value;
//         formulario.appendChild(inputImagen);

//         formulario.submit();
//     } else {
//         alert('Error al subir la imagen :31')
//     }
// }