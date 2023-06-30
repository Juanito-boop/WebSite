<?php
$curl = curl_init();

$data = file_get_contents(filename: 'php://input');
$data = urldecode($data);
parse_str($data, result: $params);

$miQuery = $_POST['query'] ?? '';

if (empty($miQuery)) {
    $apikey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU';

    // Realizar la solicitud a la API y obtener la respuesta
    $url = 'https://' . $_ENV['ID_PROJECT'] . '.supabase.co/rest/v1/vinos?select=*';
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
            'apikey: ' . $apikey,
            'Authorization: Bearer ' . $apikey,
        ],
    ]);
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Filtrar los registros excluyendo los valores enteros en las columnas relevantes
    $filteredData = array_filter($data, function ($record) {
        foreach ($record as $value) {
            if (is_numeric($value) && floor($value) == $value) {
                return false; // Excluir el registro si contiene un valor entero
            }
        }
        return true; // Incluir el registro si no contiene valores enteros
    });

    // Función personalizada para combinar los registros filtrados con las demás columnas
    function combineColumns($filteredRecord, $originalRecord): array
    {
        return array_merge($originalRecord, $filteredRecord);
    }

    // Combinar los registros filtrados con las demás columnas
    $combinedData = array_map('combineColumns', (array)$filteredData, $data);

    // Utilizar los resultados combinados
    foreach ($combinedData as $record) {
        // Realizar las operaciones deseadas con los registros
        print_r($record);
    }
}