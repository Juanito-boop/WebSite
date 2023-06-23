<?php

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://' . $_ENV['ID_PROJECT'] . '.supabase.co/rest/v1/vinos?nombre=eq.Petirrojo',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'PATCH',
    CURLOPT_POSTFIELDS => '{"nombre": "Petirrojo"}',
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU',
        'Content-Type: application/json',
        'Prefer: return=minimal',
        'apikey: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU',
    ],
]);

$respuestaPatchVinos = curl_exec($curl);

if ($respuestaPatchVinos === false) {
    $err = curl_error($curl);
} else {
    $dataPatchVinos = json_decode($respuestaPatchVinos, associative: true);
    if ($dataPatchVinos === null) {
        $err = 'Error al decodificar el JSON';
    }
}

if (isset($dataPatchVinos)) {
    // print_r($dataPatchVinos);
}

curl_close($curl);