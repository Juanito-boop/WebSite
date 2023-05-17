<?php

// $databaseFilePath = realpath(
//     path: __DIR__ .
//     DIRECTORY_SEPARATOR . '..' .
//     DIRECTORY_SEPARATOR . '..' .
//     DIRECTORY_SEPARATOR . 'db' .
//     DIRECTORY_SEPARATOR . 'DatabaseV2.php'
// );

$apiProductosFilePath = realpath(
    path: __DIR__ .
    DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'api' .
    DIRECTORY_SEPARATOR . 'supabaseProductos.php'
);
$apiSeccionesFilePath = realpath(
    path: __DIR__ .
    DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'api' .
    DIRECTORY_SEPARATOR . 'supabaseSecciones.php'
);

require_once($apiProductosFilePath);
require_once($apiSeccionesFilePath);

$data = file_get_contents(filename: 'php://input');
$data = urldecode($data);
parse_str($data, result: $params);

$miQuery = $_POST['query'] ?? '';

if (empty($miQuery)) {

    $stmt_productos = $pdo->prepare(
        /** @lang text */
        query: 'SELECT 
            paises.pais         AS pais_vino,      secciones.nombre AS seccion_vino,
            variedades.variedad AS uva_vino,       vinos.id         AS id_vino,
            vinos.id_categoria  AS categoria_vino, vinos.id_imagen  AS imagen_vino,
            vinos.nombre        AS nombre_vino,    vinos.precio     AS precio_vino,
            vinos.promocion     AS promocion,      vinos.busqueda   AS busqueda_vino
         FROM vinos 
            INNER JOIN variedades ON variedades.id = vinos.variedad 
            INNER JOIN paises     ON vinos.pais = paises.id 
            INNER JOIN secciones  ON vinos.id_categoria = secciones.id
         '
    );
    $stmt_secciones = $pdo->prepare(
        /** @lang text */
        query: 'SELECT * FROM secciones WHERE id_unica != 4 and activo = false'
    );

} else {

    $stmt_productos = $pdo->prepare(
        /** @lang text */
        query: 'SELECT 
                paises.pais         AS pais_vino,      secciones.nombre AS seccion_vino,
                variedades.variedad AS uva_vino,       vinos.id         AS id_vino,
                vinos.id_imagen     AS imagen_vino,    vinos.nombre     AS nombre_vino,
                vinos.precio        AS precio_vino,    vinos.promocion  AS promocion,
                vinos.busqueda      AS busqueda_vino
             FROM vinos 
                INNER JOIN variedades ON variedades.id = vinos.variedad 
                INNER JOIN paises     ON vinos.pais = paises.id 
                INNER JOIN secciones  ON vinos.id_categoria = secciones.id
             WHERE 
                paises.pais          LIKE ? OR
                variedades.variedad  LIKE ? OR
                vinos.nombre         LIKE ? OR
                vinos.precio/4568.38 >= ?'
    );

    $stmt_productos->bindValue(param: 1, value: '%' . $miQuery . '%');
    $stmt_productos->bindValue(param: 2, value: '%' . $miQuery . '%');
    $stmt_productos->bindValue(param: 3, value: '%' . $miQuery . '%');
    if (is_numeric($miQuery)) {
        $stmt_productos->bindValue(param: 4, value: (int) $miQuery, type: PDO::PARAM_INT);
    } else {
        $stmt_productos->bindValue(param: 4, value: $miQuery);
    }
    $stmt_secciones = $pdo->prepare(
        /** @lang text */
        query: 'SELECT * FROM secciones WHERE id_unica = 4'
    );
}

$stmt_filtro = $pdo->prepare(
    /** @lang text */
    query: "SELECT REPLACE(variedad, ' ', '_') AS uva_, variedad AS uva FROM variedades"
);