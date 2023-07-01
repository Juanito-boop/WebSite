<?php

use API\TABLES\supabaseSecciones;
use API\TABLES\supabaseVariedades;
use API\TABLES\supabasePaises;

require_once '../../api/TABLES/supabaseVariedades.php';
require_once '../../api/TABLES/supabasePaises.php';
require_once '../../api/TABLES/supabaseSecciones.php';

$getVariedades = new supabaseVariedades();
$getPaises = new supabasePaises();
$getSecciones = new supabaseSecciones();

$resultsV = $getVariedades->getVariedades();
$resultsP = $getPaises->getPaises();
$resultsS = $getSecciones->getSecciones();

function generarOpcionesVariedad(): void
{
    global $resultsV;
    if (!empty($resultsV)) {
        echo "<option value='' name='variedad'>Seleccione una cepa</option>";
        foreach ($resultsV as $result) {
            $divId = $result['id'];
            $divText = $result['variedad'];
            echo "<option value='$divId' name='variedad'>$divText</option>";
        }
    }
}

function generarOpcionesPaises(): void
{
    global $resultsP;
    if (!empty($resultsP)) {
        echo "<option value='' name='pais'>Seleccione un país</option>";
        foreach ($resultsP as $result) {
            $divId = $result['id'];
            $divText = $result['pais'];
            echo "<option value='$divId' name='pais'>$divText</option>";
        }
    }
}
function categorias(): void
{
    global $resultsS;
    if (!empty($resultsS)) {
        echo "<option value='' name='categoria'>Seleccione una categoría</option>";
        foreach ($resultsS as $result) {
            $divId = $result['id_unica'];
            $divText = $result['nombre'];
            echo "<option value='$divId' name='categoria'>$divText</option>";
        }
    }
}

function tipos(): void
{
    $opciones = array("Tinto", "Blanco", "Rosado", "Espumoso", "Dulce", "Otro");

    if (!empty($opciones)) {
        echo "<option value='' name='tipo'>Seleccione un tipo</option>";
        foreach ($opciones as $opcion) {
            echo "<option value='$opcion' name='tipo'>$opcion</option>";
        }
    }

}