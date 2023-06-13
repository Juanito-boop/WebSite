<?php
$curl = curl_init();

$data = file_get_contents(filename: 'php://input');
$data = urldecode($data);
parse_str($data, result: $params);

$miQuery = $_POST['query'] ?? '';

if (empty($miQuery)) {
    $apikey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU';

    // Realizar la solicitud a la API y obtener la respuesta
    $url = 'https://npuxpuelimayqrsmzqur.supabase.co/rest/v1/vinos?select=*';
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
    function combineColumns($filteredRecord, $originalRecord)
    {
        return array_merge($originalRecord, $filteredRecord);
    }

    // Combinar los registros filtrados con las demás columnas
    $combinedData = array_map('combineColumns', $filteredData, $data);

    // Utilizar los resultados combinados
    foreach ($combinedData as $record) {
        // Realizar las operaciones deseadas con los registros
        print_r($record);
    }


} else {

    // if (isset($pdo)) {
    //     $stmt_productos = $pdo->prepare(
    //         /** @lang text */
    //         query: 'SELECT 
    //                     paises.pais         AS pais_vino,      secciones.nombre AS seccion_vino,
    //                     variedades.variedad AS uva_vino,       vinos.id         AS id_vino,
    //                     vinos.id_imagen     AS imagen_vino,    vinos.nombre     AS nombre_vino,
    //                     vinos.precio        AS precio_vino,    vinos.promocion  AS promocion,
    //                     vinos.busqueda      AS busqueda_vino
    //                 FROM vinos 
    //                     INNER JOIN variedades ON variedades.id = vinos.variedad 
    //                     INNER JOIN paises     ON vinos.pais = paises.id 
    //                     INNER JOIN secciones  ON vinos.id_categoria = secciones.id
    //                 WHERE 
    //                     paises.pais          LIKE ? OR
    //                     variedades.variedad  LIKE ? OR
    //                     vinos.nombre         LIKE ? OR
    //                     vinos.precio/4568.38 >= ?'
    //     );
    // }
    // $stmt_productos->bindValue(param: 1, value: '%' . $miQuery . '%');
    // $stmt_productos->bindValue(param: 2, value: '%' . $miQuery . '%');
    // $stmt_productos->bindValue(param: 3, value: '%' . $miQuery . '%');
    // if (is_numeric($miQuery)) {
    //     $stmt_productos->bindValue(param: 4, value: (int) $miQuery, type: PDO::PARAM_INT);
    // } else {
    //     $stmt_productos->bindValue(param: 4, value: $miQuery);
    // }
    // $stmt_secciones = $pdo->prepare(
    //     /** @lang text */
    //     query: 'SELECT * FROM secciones WHERE id_unica = 4'
    // );
}

$stmt_filtro = $pdo->prepare(
    /** @lang text */
    query: "SELECT REPLACE(variedad, ' ', '_') AS uva_, variedad AS uva FROM variedades"
);