<?php
$obj = new Connection();
$conn = $obj->Conexion();
$stmt = $conn->prepare("SELECT REPLACE(variedad, ' ', '_') AS uva_, variedad AS uva FROM variedades");
$stmt->execute();
$results = $stmt->fetchAll();
function generarDivsVariedadConCheckbox()
{
    // Generar los divs con checkbox
    global $results;
    foreach ($results as $result) {
        $divId = $result['uva_'];
        $divText = $result['uva'];
        echo "<div id='$divId'>";
        echo "<label><input type='checkbox' name='divCheckbox[]' value='$divId'>$divText</label>";
        echo "</div>";
    }

}
?>