<?php
include_once 'config/database.php';

$_sentencia_productos = $_base_de_datos->query("SELECT nombre, sepa, descripcion, precio, id_categoria, producto, activo, promocion, mostrar, nuevo_precio FROM tienda.productos where mostrar = true");
$_resultado_productos = $_sentencia_productos->fetchAll(PDO::FETCH_ASSOC); //especifica un array indexado por columnas

$_sentencia_secciones = $_base_de_datos->query("SELECT nombre, activo, id_unica FROM tienda.secciones where activo = true");
$_resultado_secciones = $_sentencia_secciones->fetchAll(PDO::FETCH_ASSOC); //especifica un array indexado por columnas

function tarjetas($_x)
{
    global $_resultado_secciones, $_resultado_productos; //Agrega las variables globales para que puedan ser accedidas en esta función
    foreach ($_resultado_secciones as $_seccion_productos) {
        if ($_seccion_productos['id_unica'] == $_x) {
            echo '<h2 class = "main-title"><strong>' . $_seccion_productos['nombre'] . '</strong></h2>';
            echo '<div class = "container-products">';
            foreach ($_resultado_productos as $_productos) {
                $_promocion = $_productos['promocion'];
                $_categoria = $_productos['id_categoria'];
                $_unique = $_productos['producto'];
                $_imagen = file_exists("img/vinos/" . $_unique . ".png") ? "img/vinos/" . $_unique . ".png" : "img/logo.png";
                if ($_categoria == $_x && !$_promocion) {
                    echo '<div  class = "product">';
                    echo '<div  class = "product_description">';
                    echo '<img  src   = "' . $_imagen . '" alt = "" class = "product_img">';
                    echo '<h3   class = "product_title">' . $_productos['nombre'] . '</h3>';
                    echo '<h3   class = "product_title">' . $_productos['sepa'] . '</h3>';
                    echo '<span class = "product_price">' . number_format($_productos['precio'], 3, '.', ',') . '</span>';
                    if ($_productos['promocion'] === true) {
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