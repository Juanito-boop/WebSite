<?php

require_once('./config/Database.php');

$obj = new Database();
$conn = $obj->Conexion();

$miQuery = filter_input(
    INPUT_POST,
    'query'
);

// $miQuery = 'Merlot';

if ($conn == null) {
    echo null;
} else {
    if (empty($miQuery)) {

        $stmt_productos = $conn->prepare(
            'SELECT 
            paises.pais         AS pais,
            secciones.nombre    AS seccion,
            variedades.variedad AS uva,
            vinos.id            AS id_vino,
            vinos.id_categoria  AS categoria,
            vinos.id_imagen     AS imagen,
            vinos.nombre        AS nombre_vino,
            vinos.precio        AS precio_vino,
            vinos.promocion     AS promocion
            FROM vinos 
            INNER JOIN variedades ON variedades.id = vinos.variedad 
            INNER JOIN paises     ON vinos.pais = paises.id 
            INNER JOIN secciones  ON vinos.id_categoria = secciones.id'
        );

        $stmt_secciones = $conn->prepare(
            'SELECT * FROM secciones LIMIT 3'
        );

        $stmt_filtro = $conn->prepare(
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
        $arreglo_filtro = $stmt_filtro->fetchAll(PDO::FETCH_ASSOC);

        include_once('./modulos/tarjetas/tarjetas.php');
        include_once('./modulos/filtro/filtro.php');

    } else {

        $stmt_productos = $conn->prepare(
            'SELECT 
            paises.pais         AS pais,
            secciones.nombre    AS seccion,
            variedades.variedad AS uva,
            vinos.id            AS id_vino,
            vinos.id_categoria  AS categoria,
            vinos.id_imagen     AS imagen,
            vinos.nombre        AS nombre_vino,
            vinos.precio        AS precio_vino,
            vinos.promocion     AS promocion
            FROM vinos 
            INNER JOIN variedades ON variedades.id = vinos.variedad 
            INNER JOIN paises     ON vinos.pais = paises.id 
            INNER JOIN secciones  ON vinos.id_categoria = secciones.id
            WHERE 
            nombre_pais = ? OR 
            uva_vino    = ? OR 
            nombre_vino = ?'
        );

        $stmt_productos->execute(["%$miQuery%", "%$miQuery%", "%$miQuery%"]);

        if (empty($stmt_productos)) {

            $stmt_productos = $conn->prepare(
                'SELECT 
                paises.pais         AS pais,
                secciones.nombre    AS seccion,
                variedades.variedad AS uva,
                vinos.id            AS id_vino,
                vinos.id_categoria  AS categoria,
                vinos.id_imagen     AS imagen,
                vinos.nombre        AS nombre_vino,
                vinos.precio        AS precio_vino,
                vinos.promocion     AS promocion
                FROM vinos 
                INNER JOIN variedades ON variedades.id = vinos.variedad 
                INNER JOIN paises     ON vinos.pais = paises.id 
                INNER JOIN secciones  ON vinos.id_categoria = secciones.id'
            );

            $stmt_secciones = $conn->prepare(
                'SELECT * FROM secciones LIMIT 3'
            );

            $stmt_filtro = $conn->prepare(
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
            $arreglo_filtro = $stmt_filtro->fetchAll(PDO::FETCH_ASSOC);

            include_once('./modulos/tarjetas/tarjetas.php');
            include_once('./modulos/filtro/filtro.php');

        } else {

            $stmt_secciones = $conn->prepare(
                'SELECT * FROM secciones WHERE id_unica = 4'
            );

            $stmt_filtro = $conn->prepare(
                "SELECT 
            REPLACE(variedad, ' ', '_') AS uva_, 
            variedad AS uva 
            FROM variedades"
            );

            $stmt_secciones->execute();
            $stmt_filtro->execute();

            $arreglo_productos = $stmt_productos->fetchAll(PDO::FETCH_ASSOC);
            $arreglo_secciones = $stmt_secciones->fetchAll(PDO::FETCH_ASSOC);
            $arreglo_filtro = $stmt_filtro->fetchAll(PDO::FETCH_ASSOC);

            include_once('./modulos/tarjetas/tarjetas.php');
            include_once('./modulos/filtro/filtro.php');

        }

    }
}