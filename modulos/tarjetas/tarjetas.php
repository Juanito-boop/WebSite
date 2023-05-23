<?php

require './api/supabaseProductos.php';
require './api/supabaseSecciones.php';

/* Comprobando si la variable `data_productos` está configurada y si lo está
asigna su valor a la variable `productos`. */
if (isset($data_productos))
    $productos = $data_productos;
/* Comprobando si la variable `data_secciones` está configurada y si lo está
asigna su valor a la variable `secciones`. */
if (isset($data_secciones))
    $secciones = $data_secciones;

/**
 * Esta función devuelve un botón con un enlace a la página de información o
 * promoción de un producto, según los parámetros de entrada.
 * 
 * @param $isPromotion - Un valor booleano que indica si el botón es para una
 * promoción o no.
 * @param $unique - El identificador único del producto o promoción.
 * @return string Una cadena que contiene un elemento de anclaje HTML con un enlace
 * a una página de detalles y un botón con el texto "PROMOCIÓN" o "INFORMACIÓN",
 * según el valor del parámetro . La clase del botón también está
 * determinada por el parámetro . El parámetro  se usa para
 * generar un identificador único para la página de detalles.
 */
function get_button($isPromotion, $unique): string
{
    $class = $isPromotion ? 'promotion-btn' : 'product-btn';
    $text = $isPromotion ? 'PROMOCION' : 'INFORMACION';
    return '<a href="./modulos/detalles/info.php?id=' . $unique . '" class="' . $class . '" >
                <img src="./img/magnifying-glass-plus-solid.svg" style="width: 15px;color: #efb810;" alt="' . $text . '">&nbsp;' . $text . '
            </a>';
}

/**
 * @param $producto - Un array asociativo que contiene información sobre un producto
 * específico, incluida su categoría, nombre, precio, promoción, identificación
 * única, URL de imagen y variedad de uva.
 * @param $categoriaSeleccionada - La categoría seleccionada por la que se debe
 * filtrar el producto. 
 * 
 * @return string|void cadena de código HTML que representa un producto, si la categoría
 * del producto coincide con la categoría seleccionada.
 */
function get_product($producto, $categoriaSeleccionada)
{
    $categoria = $producto['id_categoria'];
    $nombre_vino = $producto['nombre'];
    $precio_vino = $producto['precio'];
    $promocion = $producto['promocion'];
    $unique = $producto['id_unica'];
    $url = $producto['url_imagen'];
    $cepa = $producto['variedades']['variedad'];

    $button = get_button($promocion, $unique);

    $taza_cambio = 4568.38;

    $precio_cop = $precio_vino * $taza_cambio;
    $precio_final = number_format($precio_cop, 0, ',', '.');

    if ($categoria == $categoriaSeleccionada) {
        return '
        <div class="product">
            <div class="product_description">
                <img src="' . $url . '" alt="" class="product_img">
                <h2 class="product_title bold">' . $nombre_vino . '</h2>
                <h2 class="product_description bold">' . $cepa . '</h2>
                <h2 class="product_price bold"> $' . $precio_final . ' COP </h2>
                ' . $button . '
            </div>
        </div>';
    }
}

/**
 * Esta función devuelve una cadena que contiene código HTML para una sección de
 * productos según la sección seleccionada y los datos del producto.
 * 
 * @param $seccion - Es un Array asociativo que contiene información sobre una sección de
 * productos, incluido su nombre.
 * @param $seccionSeleccionada - La sección (o categoría) de productos seleccionada.
 * @param $productos - El parámetro productos es array asociativo de productos que
 * pertenecen a una determinada sección.
 * 
 * @return string Una cadena que contiene código HTML para una sección de
 * productos, con un título y un contenedor para los productos. Los productos se
 * obtienen de una matriz de productos y se les da formato usando la función
 * `get_product`. El número de sección se incrementa usando una variable estática `i`
 */
function get_section($seccion, $seccionSeleccionada, $productos): string
{
    static $i = 1;
    $section = '<h2 class="main-title">
                    <strong>
                        ' . $seccion['nombre'] . '
                    </strong>
                </h2>';
    $section .= '<div class="container-products" id="container' . $i . '">';
    foreach ($productos as $producto) {
        $section .= get_product($producto, $seccionSeleccionada);
    }
    $section .= '</div>';
    $i++;
    return $section;
}

/** 
 * La función devuelve todas las secciones que coinciden con un ID de sección
 * determinado, junto con sus productos correspondientes.
 * 
 * @param $secciones una matriz de todas las secciones disponibles
 * @param $seccionID El ID de la sección que queremos recuperar.
 * @param $productos Es una variable que no se utiliza en la función dada. Por lo tanto, no podemos determinar su tipo de datos o contenido.
 * 
 * @return string una cadena que contiene el código HTML para todas las secciones
 * que coinciden con la ID de sección dada, usando la función `get_section()` para
 * generar el código HTML para cada sección.
 */
function get_all_sections($secciones, $seccionID, $productos): string
{
    $sections = "";
    foreach ($secciones as $seccion) {
        if ($seccion["id_unica"] == $seccionID) {
            $sections .= get_section($seccion, $seccionID, $productos);
        }
    }
    return $sections;
}

/**
 * La función "tarjetas" muestra todos los productos de una determinada sección.
 * 
 * @param $seccionID El parámetro `seccionID` es una variable que representa el ID
 * de una sección. Se utiliza para recuperar todos los productos que pertenecen a
 * esa sección y mostrarlos en formato de tarjeta.
 * 
 * @return void
 */
function tarjetas($seccionID): void
{
    global $secciones, $productos;
    $sections = get_all_sections($secciones, $seccionID, $productos);
    echo $sections;
}

/**
 * La función genera un conjunto de divs que contienen tarjetas y botones de
 * paginación para cada sección en una matriz.
 * 
 * @return void
 */
function tarjetasFin(): void
{
    global $secciones;
    $total_secciones = count($secciones);
    for ($i = 1; $i <= $total_secciones; $i++) {
        echo '<div>';
        tarjetas($i);
        echo '<div class="pagination">';
        echo '<button id="prev-btn' . $i . '">🔙</button>';
        echo '<button id="next-btn' . $i . '">🔜</button>';
        echo '</div>';
        echo '</div>';
    }
}