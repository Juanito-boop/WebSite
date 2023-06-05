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
// -----> Building on the Heroku - 22 stack
// -----> Using buildpack: heroku / php
// -----> PHP app detected

// !WARNING: No 'composer.json' found!
// !
//     !Your project only contains an 'index.php', no 'composer.json'.
//  !
//     !Using 'index.php' to declare app type as PHP is deprecated and
// !may lead to unexpected behavior.
//  !
//     !Please consider updating your codebase to utilize Composer and
// !modern dependency management in order to benefit from the latest
// !PHP runtimes and improved application performance, as well as
//     !control over the PHP versions and extensions available.
//  !
//     !For an introduction to dependency management with Composer and
// !how to get the most out of PHP on Heroku, refer to the docs at
// !https://getcomposer.org/doc/00-intro.md and
// !https://devcenter.heroku.com/articles/getting-started-with-php
// -----> Bootstrapping...
// -----> Preparing platform package installation...
// NOTICE: No runtime required in composer.lock; using PHP ^ 8.0.0
// -----> Installing platform packages...
// - apache(2.4.57)
//     - php(8.2.6)
//     - composer(2.2.20)
//     - nginx(1.24.0)
// -----> Installing dependencies...
//        Composer version 2.2.20 2023 - 02 - 10 14: 11: 10
// -----> Preparing runtime environment...
// NOTICE: No Procfile, using 'web: heroku-php-apache2'.
// -----> Checking for additional extensions to install...
// -----> Discovering process types
//        Procfile declares types -> web
// -----> Compressing...