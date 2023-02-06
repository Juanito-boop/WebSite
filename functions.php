<?php
include_once 'config/database.php';

$sentencia_productos = $base_de_datos->query("SELECT nombre, sepa, descripcion, precio, id_categoria, producto, activo, promocion, mostrar, nuevo_precio FROM tienda.productos where mostrar = true");
$resultado_productos = $sentencia_productos->fetchAll(PDO::FETCH_ASSOC); //especifica un array indexado por columnas

$sentencia_secciones = $base_de_datos->query("SELECT nombre, activo, id_unica FROM tienda.secciones where activo = true");
$resultado_secciones = $sentencia_secciones->fetchAll(PDO::FETCH_ASSOC); //especifica un array indexado por columnas

function tarjetas($x)
{
    global $resultado_secciones, $resultado_productos; //Agrega las variables globales para que puedan ser accedidas en esta función
    foreach ($resultado_secciones as $seccion_productos) {
        if ($seccion_productos['id_unica'] == $x) {
            echo '<h2 class = "main-title"><strong>' . $seccion_productos['nombre'] . '</strong></h2>';
            echo '<div class = "container-products">';
            foreach ($resultado_productos as $productos) {
                $promocion = $productos['promocion'];
                $categoria = $productos['id_categoria'];
                $unique = $productos['producto'];
                $imagen = file_exists("img/vinos/" . $unique . ".png") ? "img/vinos/" . $unique . ".png" : "img/logo.png";
                if ($categoria == $x && !$promocion) {
                    echo '<div  class = "product">';
                    echo '<div  class = "product_description">';
                    echo '<img  src   = "' . $imagen . '" alt = "" class = "product_img">';
                    echo '<h3   class = "product_title">' . $productos['nombre'] . '</h3>';
                    echo '<h3   class = "product_title">' . $productos['sepa'] . '</h3>';
                    echo '<span class = "product_price">' . number_format($productos['precio'], 3, '.', ',') . '</span>';
                    if ($productos['promocion'] === true) {
                        echo '<a href = "" class = "promotion-btn"><em class = "fas fa-shopping-cart"> COMPRAR </em></a>';
                    } else {
                        echo '<a href = "" class = "product-btn"><em class = "fas fa-shopping-cart"> COMPRAR </em></a>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            }
            echo '</div>';
        }
    }
}

?>