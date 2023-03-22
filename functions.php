<?php
include_once 'config/database.php';

// Seleccionar productos de la tabla 'productos' donde 'mostrar' sea verdadero
$_sentencia_productos = $_base_de_datos->query("SELECT nombre, sepa, descripcion, precio, id_categoria, producto, activo, promocion, mostrar, nuevo_precio FROM tienda.productos WHERE mostrar = true");
// Seleccionar secciones de la tabla 'secciones' donde 'activo' sea verdadero
$_sentencia_secciones = $_base_de_datos->query("SELECT nombre, activo, id_unica FROM tienda.secciones WHERE activo = true");
// Salida: $_sentencia_productos y $_sentencia_secciones, que contienen resultados de consulta de base de datos.

//especifica un array indexado por columnas
$_resultado_productos = $_sentencia_productos->fetchAll(PDO::FETCH_ASSOC); 
$_resultado_secciones = $_sentencia_secciones->fetchAll(PDO::FETCH_ASSOC);

//La función tarjetas() imprime cajas de productos de acuerdo a la sección que se le pase (identificada por $_x)
function tarjetas($_x)
{
    //Se agrega el acceso a las variables globales $_resultado_secciones y $_resultado_productos
    global $_resultado_secciones, $_resultado_productos;
    //Se recorren todas las secciones guardadas en $_resultado_secciones
    foreach ($_resultado_secciones as $_seccion_productos) {
        //Si la sección actual es igual a la que se está buscando ($_x)
        if ($_seccion_productos['id_unica'] == $_x) {
            //Imprime el título de la sección
            echo '<h2 class="main-title"><strong>' . $_seccion_productos['nombre'] . '</strong></h2>';
            echo '<div class="container-products">';
            //Recorre todos los productos guardados en $_resultado_productos
            foreach ($_resultado_productos as $_productos) {
                //Guarda en una variable $_promocion si el producto actual está en promoción
                $_promocion = $_productos['promocion'];
                //Guarda en una variable $_categoria la categoría del producto actual
                $_categoria = $_productos['id_categoria'];
                //Guarda en una variable $_unique el nombre único del producto
                $_unique = $_productos['producto'];
                //Guarda en una variable $_imagen la ruta de la imagen del producto actual (usa un logo por defecto si no existe la imagen)
                $_imagen = file_exists("img/vinos/" . $_unique . ".png") ? "img/vinos/" . $_unique . ".png" : "img/logo.png";
                if ($_categoria == $_x && !$_promocion) {
                    //Si el producto actual pertenece a la categoría buscada ($_x) y no está en promoción
                    //Imprime la caja del producto actual
                    echo '<div class="product">';
                    echo '<div class="product_description">';
                    echo '<img src="' . $_imagen . '" alt="" class="product_img">';
                    echo '<h3 class="product_title">' . $_productos['nombre'] . '</h3>';
                    echo '<h3 class="product_title">' . $_productos['sepa'] . '</h3>';
                    echo '<span class="product_price">' . number_format($_productos['precio'], 3, '.', ',') . '</span>';
                    //Si el producto está en promoción, muestra un botón especial para comprar
                    if ($_productos['promocion'] === true) {
                        echo '<a href="" class="promotion-btn"><em class="fas fa-shopping-cart"> COMPRAR </em></a>';
                    } else {
                        echo '<a href="" class="product-btn"><em class="fas fa-shopping-cart"> COMPRAR </em></a>';
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