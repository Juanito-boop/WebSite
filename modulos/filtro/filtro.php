<?php

require_once '../../api/GET/supabaseGetVariedades.php';
require_once '../../api/GET/supabaseGetPaises.php';
require_once '../../api/GET/supabaseGetSecciones.php';

use API\TABLES\GET\supabaseGetSecciones as supaSecciones;
use API\TABLES\GET\supabaseGetPaises as supaPaises;

if (isset($dataGetVariedades)) {
    $resultsV = $dataGetVariedades;
}
if (isset($dataGetPaises)) {
    $resultsP = $dataGetPaises;
}

$resultadosSecciones = new supaSecciones();
$resultadosPaises = new supaPaises();
$resultsS = $resultadosSecciones->getSecciones();

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
            echo "<<option value='$divId' name='pais'>$divText</option>";
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