

<?php
//Incluimos la conexión a la base de datos
require_once('conexion.php');
 
// Creamos una variable para almacenar el resultado de la consulta
$resultado = array();
 
// Comprobamos si se ha enviado alguna información por el método GET para realizar una búsqueda específica
if(isset($_GET['busqueda'])){
    // Preparamos la consulta SQL para buscar los registros que coincidan con los parámetros recibidos por GET
    $sql = "SELECT * FROM tabla WHERE campo LIKE '%".$_GET['busqueda']."%'"; 

    // Realizamos la consulta a la base de datos y almacenamos el resultado en un arreglo asociativo 
    $resultado = $conexion->query($sql); 

    // Si hay resultados, los devolvemos como JSON, sino devolvemos un mensaje de error. 
    if ($resultado->num_rows > 0) { 
        $datos = array();
        while($row = $resultado->fetch_assoc()) { 

            $datos[] = $row;
        }

        echo json_encode($datos);

    } else { 

        echo json_encode(array("error" => "No hay resultados"));

    }  
} else { 

    echo json_encode(array("error" => "No se ha recibido ninguna búsqueda"));  
}