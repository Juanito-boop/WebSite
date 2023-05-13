<?php

// use DatabaseV2;

$databaseFilePath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR . 'DatabaseV2.php');
require_once($databaseFilePath);

function databaseQueryTask()
{
    $db = new DatabaseV2();
    $pdo = $db->getConnection();

    $data = file_get_contents('php://input');
    $data = urldecode($data);
    parse_str($data, $params);

    $miQuery = isset($_POST['query']) ? $_POST['query'] : '';
    if (empty($miQuery)) {

        $stmt_productos = $pdo->prepare(
            'SELECT 
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
            'SELECT * FROM secciones WHERE CAST(id_unica AS integer) != 4'
        );

        $stmt_filtro = $pdo->prepare(
            "SELECT 
            REPLACE(variedad, ' ', '_') AS uva_, 
            variedad AS uva 
            FROM variedades"
        );

        $stmt_productos->execute();
        $stmt_secciones->execute();

        $stmt_filtro->execute();

        $arreglo_productos = $stmt_productos->fetchAll(PDO::FETCH_ASSOC);
        $arreglo_secciones = $stmt_secciones->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['resultado_productos'] = $arreglo_productos;
        $_SESSION['resultado_secciones'] = $arreglo_secciones;

        $arreglo_filtro = $stmt_filtro->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['arreglo_filtro'] = $arreglo_filtro;

    } else {

        $stmt_productos = $pdo->prepare(
            'SELECT 
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

        $stmt_productos->bindValue(1, '%' . $miQuery . '%', PDO::PARAM_STR);
        $stmt_productos->bindValue(2, '%' . $miQuery . '%', PDO::PARAM_STR);
        $stmt_productos->bindValue(3, '%' . $miQuery . '%', PDO::PARAM_STR);
        if (is_numeric($miQuery)) {
            // Si $miQuery es un número, asignamos su valor como entero
            $stmt_productos->bindValue(4, (int) $miQuery, PDO::PARAM_INT);
        } else {
            // Si $miQuery es una cadena, asignamos su valor como cadena
            $stmt_productos->bindValue(4, $miQuery, PDO::PARAM_STR);
        }

        $stmt_secciones = $pdo->prepare(
            'SELECT * FROM secciones WHERE CAST(id_unica AS integer) = 4'
        );

        $stmt_filtro = $pdo->prepare(
            "SELECT 
            REPLACE(variedad, ' ', '_') AS uva_, 
            variedad AS uva 
            FROM variedades"
        );

        $stmt_productos->execute();
        $stmt_secciones->execute();

        $stmt_filtro->execute();

        $arreglo_productos = $stmt_productos->fetchAll(PDO::FETCH_ASSOC);
        $arreglo_secciones = $stmt_secciones->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['resultado_productos'] = $arreglo_productos;
        $_SESSION['resultado_secciones'] = $arreglo_secciones;

        $arreglo_filtro = $stmt_filtro->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['arreglo_filtro'] = $arreglo_filtro;

    }
}

$thread = new $thread('databaseQueryTask');
$thread->start();