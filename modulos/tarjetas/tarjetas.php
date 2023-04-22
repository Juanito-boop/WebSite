<?php
// Incluye el archivo `database.php` y crea un nuevo objeto `Connection`. Luego llama al método
// `Conexion()` en el objeto para establecer una conexión con la base de datos y asigna el objeto de
// conexión resultante a la variable `$conn`.
include_once './config/database.php';
$obj = new Connection();
$conn = $obj->Conexion();

// La variable `$sentencia_productos` está ejecutando una consulta SQL para recuperar datos de varias
// tablas (`vinos`, `variedades`, `paises` y `secciones`) usando combinaciones internas. La consulta
// selecciona columnas específicas de cada tabla y alias algunas de ellas con nuevos nombres
// (`nombre_vino`, `precio_vino`, `uva`, `pais`, `seccion` y `categoria`). El conjunto de resultados
// contendrá información sobre los vinos, incluido su nombre, precio, imagen, estado de promoción,
// variedad de uva, país de origen, categoría y si están activos o no.
$sentencia_productos = $conn->prepare(
    "SELECT 
        paises.pais AS pais,
        secciones.nombre AS seccion,
        variedades.variedad AS uva,
        vinos.id as id_vino,
        vinos.id_categoria as categoria,
        vinos.id_imagen as imagen,
        vinos.nombre as nombre_vino,
        vinos.precio as precio_vino,
        vinos.promocion as promocion
    FROM vinos 
    INNER JOIN variedades ON variedades.id = vinos.variedad 
    INNER JOIN paises ON vinos.pais = paises.id 
    INNER JOIN secciones ON vinos.id_categoria = secciones.id"
);

// La línea de código está preparando una declaración SQL para seleccionar todas las columnas de la
// tabla "secciones" donde la columna "activo" es verdadera.
$sentencia_secciones = $conn->prepare("SELECT * FROM secciones WHERE activo = true LIMIT 3");

// Estas líneas de código ejecutan instrucciones SQL preparadas para recuperar datos de las tablas de
// la base de datos `vinos`, `variedades`, `paises` y `secciones`. Los resultados de estas consultas se
// almacenan en las variables `$sentencia_productos` y `$sentencia_secciones`, respectivamente, que se
// utilizarán posteriormente en el código para generar contenido HTML para el sitio web.
$sentencia_productos->execute();
$sentencia_secciones->execute();

// Estas líneas de código ejecutan declaraciones SQL preparadas y obtienen todos los resultados de las
// consultas. Los resultados se almacenan en las variables `$resultado_productos` y
// `$resultado_secciones`, respectivamente. Estas variables se utilizarán más adelante en el código
// para generar contenido HTML para el sitio web.
$resultado_productos = $sentencia_productos->fetchAll();
$resultado_secciones = $sentencia_secciones->fetchAll();

// La función devuelve la ruta de un archivo de imagen en función de una ID única o una ruta de imagen
// de logotipo predeterminada si el archivo no existe.
// 
// @param unique_id El identificador único de un archivo de imagen. Se utiliza para construir la ruta
// del archivo de la imagen.
// 
// @return la ruta del archivo de imagen con la ID única proporcionada, si existe; de lo contrario,
// devuelve la ruta de un archivo de imagen predeterminado.
function get_image($unique_id)
{
    $image_path = 'img/vinos/' . $unique_id . '.png';
    $image_exists = file_exists($image_path) ? $image_path : "img/logo.png";
    return $image_exists;
}

// La función devuelve un botón con diferente texto y clase dependiendo de si es una promoción o un
// producto regular.
// 
// @param isPromotion Un valor booleano que indica si el botón es para una promoción o un producto
// normal.
// 
// @return una cadena HTML que contiene un enlace con una clase y texto basado en el valor del
// parámetro . Si  es verdadero, el enlace tendrá una clase de 'promoción-btn'
// y el texto 'PROMOCIÓN'. Si  es falso, el enlace tendrá una clase de 'product-btn' y el
// texto 'COMPRAR'
function get_button($isPromotion)
{
    $class = $isPromotion ? 'promotion-btn' : 'product-btn';
    $text = $isPromotion ? 'PROMOCION' : 'COMPRAR';
    return '<a href="" class="' . $class . '"><em class="fas fa-shopping-cart">' . $text . '</em></a>';
}

// La función devuelve el código HTML de un producto según su categoría y muestra su nombre, uva,
// precio en pesos colombianos, imagen y botón promocional.
// 
// @param productos Una matriz que contiene información sobre un producto, incluido su estado de
// promoción, categoría, identificador de imagen único, nombre, variedad de uva y precio.
// @param x La categoría del producto que queremos filtrar y mostrar.
// 
// @return Una cadena HTML que contiene la información del producto (nombre, imagen, descripción,
// precio y botón) para un producto que coincide con la categoría especificada.
function get_product($productos, $x)
{
    $promocion = $productos['promocion'];
    $categoria = $productos['categoria'];
    $unique = $productos['imagen'];
    $nombre = $productos['nombre_vino'];
    $uva = $productos['uva'];
    $precio = $productos['precio_vino'];
    $imagen = get_image($unique);
    $button = get_button($promocion);
    $taza_cambio = 4568.38;
    $precio_cop = $precio * $taza_cambio;

    if ($categoria == $x) {
        return '<div class="product">
                    <div class="product_description">
                    <img src="' . $imagen . '" alt="" class="product_img">
                    <h2 class="product_title bold">' . $nombre . '</h2>
                    <h2 class="product_description bold">' . $uva . '</h2>
                    <h2 class="product_price bold"> $' . number_format($precio_cop, 0, '.', ',') . ' COP </h2>
                    ' . $button . '
                    </div>
                </div>';
    }
}

// Esta función genera una sección de código HTML con un título y un contenedor para productos basados
// en datos de entrada.
// 
// @param resultado_secciones Es una variable que contiene una matriz con información sobre una
// sección, como su nombre.
// @param x La variable  se pasa como parámetro a la función get_section(), pero no se usa dentro de
// la función. Por lo tanto, su valor no es relevante para la ejecución de la función.
// @param resultado_productos Es una matriz de productos que pertenecen a una sección en particular.
// 
// @return una cadena que contiene código HTML para una sección de productos, incluido un título y un
// contenedor con los productos. Los productos se obtienen del arreglo  usando la
// función get_product(). La variable  se usa para generar una identificación única para cada
// contenedor.
function get_section($resultado_secciones, $x, $resultado_productos)
{
    static $i = 1;
    $section = '<h2 class="main-title"><strong>' . $resultado_secciones['nombre'] . '</strong></h2>';
    $section .= '<div class="container-products" id="container' . $i . '">';
    foreach ($resultado_productos as $productos) {
        $section .= get_product($productos, $x);
    }
    $section .= '</div>';
    $i++;
    return $section;
}

// La función recupera todas las secciones de un conjunto dado de resultados en función de un
// identificador único y las devuelve como una cadena.
// 
// @param resultado_secciones Es una variable que contiene un arreglo de todas las secciones y sus
// respectivos productos.
// @param x La variable  es un identificador único para una sección específica de productos. Se
// utiliza para filtrar la matriz  y recuperar solo la sección que coincide con el
// identificador dado.
// @param resultado_productos Es una variable que contiene el resultado de una consulta u operación que
// recupera una lista de productos. Es probable que sea una matriz u objeto que contenga información
// sobre cada producto, como su nombre, precio y descripción. Esta variable se usa como parámetro en la
// función get_all_sections() para ayudar
// 
// @return una cadena que contiene todas las secciones que coinciden con la ID dada, generada por la
// función `get_section()`.
function get_all_sections($resultado_secciones, $x, $resultado_productos)
{
    $sections = "";
    foreach ($resultado_secciones as $seccion_productos) {
        if ($seccion_productos['id_unica'] == $x) {
            $sections .= get_section($seccion_productos, $x, $resultado_productos);
        }
    }
    return $sections;
}

// La función "tarjetas" recupera todas las secciones y productos de un conjunto de resultados dado y
// los genera.
// 
// @param x El parámetro  está siendo pasado a la función tarjetas(). No está claro en el código dado
// qué tipo de datos es  o qué valor tiene. Es posible que  sea un parámetro de entrada que se use
// para filtrar las secciones y los productos que devuelve get_all
function tarjetas($x)
{
    global $resultado_secciones, $resultado_productos;
    $sections = get_all_sections($resultado_secciones, $x, $resultado_productos);
    echo $sections;
}

// Esta función genera un conjunto de tarjetas con paginación para cada sección en una matriz dada.
function tarjetasFin()
{
    global $resultado_secciones;
    $total_secciones = count($resultado_secciones);
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

?>