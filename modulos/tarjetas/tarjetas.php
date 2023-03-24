<?php
include_once './config/database.php';

// Seleccionar productos de la tabla 'productos' donde 'mostrar' sea verdadero
$_sentencia_productos = $_base_de_datos->query("SELECT nombre, sepa, descripcion, precio, id_categoria, producto, activo, promocion, mostrar, nuevo_precio FROM tienda.productos WHERE mostrar = true");

// Seleccionar secciones de la tabla 'secciones' donde 'activo' sea verdadero
$_sentencia_secciones = $_base_de_datos->query("SELECT nombre, activo, id_unica FROM tienda.secciones WHERE activo = true");

// Salida: $_sentencia_productos y $_sentencia_secciones, que contienen resultados de consulta de base de datos.
$_resultado_productos = $_sentencia_productos->fetchAll(PDO::FETCH_ASSOC);
$_resultado_secciones = $_sentencia_secciones->fetchAll(PDO::FETCH_ASSOC);

//Esta función obtiene la imagen del producto actual  
function get_image($_unique_id)
{
    $_image_path = 'img/vinos/' . $_unique_id . '.png';
    $_image_exists = file_exists($_image_path) ? $_image_path : "img/logo.png";
    return $_image_exists;
}

//Esta función obtiene el botón de comprar según si el producto está en promoción o no
function get_button($_isPromotion)
{
    $class = $_isPromotion ? 'promotion-btn' : 'product-btn';
    $text = $_isPromotion ? 'PROMOCION' : 'COMPRAR';
    return '<a href="" class="' . $class . '"><em class="fas fa-shopping-cart">' . $text . '</em></a>';
}

//Esta función obtiene la caja del producto actual
function get_product($_productos, $_x)
{
    $_promocion = $_productos['promocion'];
    $_categoria = $_productos['id_categoria'];
    $_unique = $_productos['producto'];
    $_imagen = get_image($_unique);
    $button = get_button($_promocion);

    if ($_categoria == $_x) {
        return '<div class="product">
              <div class="product_description">
                <img src="' . $_imagen . '" alt="" class="product_img">
                <h3 class="product__title">' . $_productos['nombre'] . '</h3>
                <h3 class="product__title">' . $_productos['sepa'] . '</h3>
                <span class="product_price">' . number_format($_productos['precio'], 3, '.', ',') . '</span>
                ' . $button . '
              </div>
            </div>';
    }
}

//Esta función obtiene la sección actual
function get_section($_seccion_productos, $_x, $_resultado_productos)
{
    $_section = '<h2 class="main-title"><strong>' . $_seccion_productos['nombre'] . '</strong></h2>';
    $_section .= '<div class="container-products">';
    foreach ($_resultado_productos as $_productos) {
        $_section .= get_product($_productos, $_x);
    }
    $_section .= '</div>';
    return $_section;
}

//Esta función obtiene la lista completa de secciones
function get_all_sections($_resultado_secciones, $_x, $_resultado_productos)
{
    $_sections = "";
    foreach ($_resultado_secciones as $_seccion_productos) {
        if ($_seccion_productos['id_unica'] == $_x) {
            $_sections .= get_section($_seccion_productos, $_x, $_resultado_productos);
        }
    }
    return $_sections;
}

//Esta función agrupa todo el contenido y lo imprime
function tarjetas($_x)
{
    global $_resultado_secciones, $_resultado_productos;
    $sections = get_all_sections($_resultado_secciones, $_x, $_resultado_productos);
    echo $sections;
}

?>