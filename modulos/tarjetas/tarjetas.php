<?php
include_once './config/database.php';

//El código ejecuta una consulta a una base de datos llamada "tienda" y a la tabla "productos". La consulta devuelve los valores de las columnas "nombre", "sepa", "descripcion", "precio", "id_categoria", "producto", "activo", "promocion", "mostrar" y "nuevo_precio" de aquellos registros donde el valor de la columna "mostrar" es igual a true. Estos valores serán almacenados en una variable llamada $_sentencia_productos. La conexión a la base de datos se realiza mediante una variable llamada $_base_de_datos.
$_sentencia_productos = $_base_de_datos->query("SELECT nombre, sepa, descripcion, precio, id_categoria, producto, activo, promocion, mostrar, nuevo_precio FROM tienda.productos WHERE mostrar = true");

//Este código ejecuta una consulta SQL a la base de datos de la tienda, en la tabla secciones, para seleccionar los nombres, valores de activo y las ids únicas de todas las secciones que estén activas. La consulta se realiza usando el método query() de $_base_de_datos que es un objeto de la clase de la conexión de la base de datos. Los resultados de la consulta se almacenan en la variable $_sentencia_secciones para que puedan ser usados posteriormente en el código.
$_sentencia_secciones = $_base_de_datos->query("SELECT nombre, activo, id_unica FROM tienda.secciones WHERE activo = true");

//El código usa la biblioteca PDO de PHP para acceder a una base de datos. La función fetchAll devuelve todas las filas del conjunto de resultados como un array asociativo, donde la clave del array es el nombre de la columna y el valor es el valor de la celda correspondiente. En el primer caso, $_resultado_productos recupera todas las filas de la sentencia SQL $_sentencia_productos y las almacena en un array asociativo usando el modo PDO::FETCH_ASSOC. En el segundo caso, $_resultado_secciones hace lo mismo para la sentencia SQL $_sentencia_secciones.

$_resultado_productos = $_sentencia_productos->fetchAll(PDO::FETCH_ASSOC);
$_resultado_secciones = $_sentencia_secciones->fetchAll(PDO::FETCH_ASSOC);

//La siguiente función recibe un parámetro único y devuelve la ruta de un archivo de imagen si existe, de lo contrario devuelve la ruta de una imagen de logo.  
function get_image($_unique_id)
{
    // Se construye la ruta de la imagen a partir del identificador único
    $_image_path = 'img/vinos/' . $_unique_id . '.png';
    // Si la imagen existe se devuelve su ruta, si no se devuelve la ruta de una imagen de logo
    $_image_exists = file_exists($_image_path) ? $_image_path : "img/logo.png";
    // Se devuelve la ruta de la imagen que se encontró
    return $_image_exists;
}

//La función get_button() acepta un parámetro booleano $_isPromotion que determina si el botón debe ser una promoción (verdadero) o un botón de compra (falso). En base a este parámetro, se asigna una clase CSS y un texto al botón. La clase y el texto se utilizan para construir la estructura HTML del botón. Finalmente, se devuelve el botón construido en forma de cadena.
function get_button($_isPromotion)
{
    $class = $_isPromotion ? 'promotion-btn' : 'product-btn';
    $text = $_isPromotion ? 'PROMOCION' : 'COMPRAR';
    return '<a href="" class="' . $class . '"><em class="fas fa-shopping-cart">' . $text . '</em></a>';
}

//Este código define una función llamada "get_product" que recibe dos parámetros: el primer parámetro es un array $_productos que contiene información de productos como 'promocion', 'id_categoria', 'producto', 'nombre', 'sepa' y 'precio'; el segundo parámetro ($_x) es una categoría de producto. El propósito de la función es devolver un bloque de HTML con información del producto que pertenece a la categoría recibida como parámetro ($_x). Primero, la función asigna variables locales para algunas de las claves del array $_productos. A continuación, llama a las funciones "get_image" y "get_button" para obtener información adicional de la imagen y el botón del producto. Luego, si la categoría del producto es igual al parámetro recibido ($_x), la función formatea un bloque de HTML que contiene la imagen, el nombre, el precio y el botón del producto, y lo devuelve como una cadena.En resumen, la función "get_product" toma información de un array de productos y devuelve un bloque de HTML que representa esa información para un producto específico que pertenece a la categoría solicitada.
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

//Este código define una función llamada "get_section" que tiene tres parámetros: $_seccion_productos, $_x y $_resultado_productos. La función comienza inicializando la variable $_section como una cadena que contiene un título en HTML con el nombre de la sección de productos pasada como parámetro. Luego, agrega otra cadena HTML que establece una clase para un contenedor de productos. A continuación, la función itera a través del arreglo de productos $_resultado_productos utilizando un bucle "foreach" y para cada producto llama a la función "get_product" con dos parámetros: el producto y $_x. La función "get_product" regresa una cadena HTML con la información del producto. Finalmente, la función "get_section" cierra el contenedor de productos y retorna la cadena HTML completa. Este código en sí mismo no produce salida visible en la pantalla ya que es una función que se puede llamar en otra parte del código.
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

//La función get_all_sections() recibe tres parámetros: $_resultado_secciones, $_x y $_resultado_productos. Esta función se encarga de recorrer el arreglo $_resultado_secciones y concatenar a la variable $_sections la salida de la función get_section() cada vez que encuentra una sección cuyo valor de id_unica coincide con el valor de $_x. La función get_section() se llama con tres parámetros: $_seccion_productos, $_x y $_resultado_productos. Al finalizar el ciclo, la función retorna el valor concatenado de $_sections.

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

//El código define una función llamada "tarjetas" que toma un parámetro llamado "$_x". Dentro de la función, se utiliza la palabra clave "global" para hacer referencia a dos variables definidas fuera de la función llamadas "$_resultado_secciones" y "$_resultado_productos". La función llama a otra función llamada "get_all_sections" pasando las tres variables como argumentos y asigna el resultado de esa función a una variable llamada "$sections". Finalmente, la función imprime el contenido de la variable "$sections" utilizando la función "echo". En resumen, la función "tarjetas" obtiene una lista de todas las secciones y productos y las imprime en la pantalla.

function tarjetas($_x)
{
    global $_resultado_secciones, $_resultado_productos;
    $sections = get_all_sections($_resultado_secciones, $_x, $_resultado_productos);
    echo $sections;
}
?>