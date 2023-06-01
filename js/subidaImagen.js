import { createClient } from '@supabase/supabase-js'

const supabaseUrl = 'https://hijaeegxjbuivzckpijg.supabase.co'
const supabaseApiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImhpamFlZWd4amJ1aXZ6Y2twaWpnIiwicm9sZSI6ImFub24iLCJpYXQiOjE2NTg1MTgxNjAsImV4cCI6MTk3NDA5NDE2MH0.dZo4cMQV2Xm1rugxdthp9Q8c40oHRkRHbrJlh4a3-BU'

const supabase = createClient(supabaseUrl, supabaseApiKey)

document.getElementById('submitBtn').addEventListener('click', function (event) {
    event.preventDefault(); // Evita que el formulario se envíe automáticamente
    alert('Subiendo imagen... :11')
    uploadFile()
});

async function uploadFile() {

    const imageInput = document.getElementById('imageInput')

    const imageFile = imageInput.files[0]
    const fileName = imageFile.name

    const { data, error } = await supabase
        .storage
        .from('imagenes-vino')
        .upload(fileName, imageFile, {
            cacheControl: '3600',
            upsert: false
        })

    if (error) {
        alert('Error al subir la imagen :21')
    } else {
        const formData = new FormData()
        formData.append('fileName', fileName)

        const response = await fetch('../modulos/carga-producto-bd/logica.php', {
            method: 'POST',
            body: formData
        })

        // Maneja la respuesta del script PHP
        if (response.ok) {
            alert('Imagen subida correctamente :33')
        } else {
            alert('Error al subir la imagen :35')
        }
    }
}