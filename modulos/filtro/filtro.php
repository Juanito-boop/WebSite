<?php

require './modulos/consultas-preparadas/consultas-preparadas.php';

$results = $arreglo_filtro;

function generarDivsVariedadConCheckbox()
{
    // Generar los divs con checkbox
    global $results;
    foreach ($results as $result) {
        $divId = $result['uva_'];
        $divText = $result['uva'];
        echo "<div class='filto'>";
        echo "<div id='$divId'>";
        echo "<label><input type='checkbox' name='divCheckbox[]' value='$divId'>" . '   ' . "$divText</label>";
        echo "</div>";
        echo "</div>";
    }
}
?>