<?php
include_once './config/database.php';
$obj = new Connection();
$conn = $obj->Conexion();

//El código selecciona todos los registros de la tabla "vinos" de la base de datos "tienda" donde la columna "activo" es verdadera. La variable "$_sentencia_productos" almacena el resultado de la consulta.
$_sentencia_productos = $conn->query("SELECT * FROM tienda.vinos WHERE activo = true");

//El código $_sentencia_secciones = $conn->query("SELECT * FROM tienda.secciones WHERE activo = true"); se utiliza para hacer una consulta a una base de datos. En este caso, se está seleccionando todas las filas de la tabla "secciones" en la base de datos "tienda" donde el valor de la columna "activo" es "true". La variable $_sentencia_secciones almacenará el resultado de la consulta, que se puede utilizar posteriormente en el código. Se asume que la variable $conn es una instancia de la conexión a la base de datos.
$_sentencia_secciones = $conn->query("SELECT * FROM tienda.secciones WHERE activo = true");

//El código ejecuta dos sentencias preparadas en PHP. La primera sentencia se ejecuta en una variable llamada $_sentencia_productos y la segunda en una variable llamada $_sentencia_secciones. Una sentencia preparada es una forma de precompilar una consulta SQL que se utilizará varias veces con diferentes valores. Esto ayuda a mejorar el rendimiento y la seguridad al evitar la necesidad de analizar la consulta cada vez que se ejecuta. La función execute() ejecuta las sentencias preparadas que se han asignado a las variables $_sentencia_productos y $_sentencia_secciones respectivamente. Esto permite que las consultas SQL en ambas sentencias preparadas se ejecuten en el motor de base de datos y se recuperen los datos correspondientes.
$_sentencia_productos->execute();
$_sentencia_secciones->execute();

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

//Esta función de PHP toma dos parámetros, uno de ellos es un array de productos ($_productos) y el otro es un ID de categoría ($_x). Luego extrae la promoción, el ID de la categoría, el ID de imagen única y el enlace de imagen del array de productos. También recupera un botón y una tasa de cambio de moneda. La función luego multiplica el precio del producto por la tasa de cambio de moneda para convertir el precio de dólares a pesos colombianos. Finalmente, verifica si el ID de la categoría del producto coincide con el ID de la categoría de entrada. Si lo hace, devuelve una cadena HTML que muestra la imagen del producto, el nombre, la variedad, el precio en pesos colombianos y un botón para la promoción. Si la categoría del producto no coincide con la categoría de entrada, la función no devuelve nada.
function get_product($_productos, $_x)
{
    $_promocion = $_productos['promocion'];
    $_categoria = $_productos['id_categoria'];
    $_unique = $_productos['id_imagen'];
    $_imagen = get_image($_unique);
    $button = get_button($_promocion);
    $taza_cambio = 4568.38;
    $precio_cop = $_productos['precio'] * $taza_cambio;

    if ($_categoria == $_x) {
        return '<div class="product">
              <div class="product_description">
                <img src="' . $_imagen . '" alt="" class="product_img">
                <h3 class="product__title bold">' . $_productos['nombre'] . '</h3>
                <h3 class="product__title bold">' . $_productos['variedad'] . '</h3>
                <span class="product_price"> $' . number_format($precio_cop, 0, '.', ',') . ' COP </span>
                ' . $button . '
              </div>
            </div>';
    }
}

//
function get_section($_seccion_productos, $_x, $_resultado_productos)
{
    static $i = 1;
    $_section = '<h2 class="main-title"><strong>' . $_seccion_productos['nombre'] . '</strong></h2>';
    $_section .= '<div class="container-products" id="container' . $i . '">';
    foreach ($_resultado_productos as $_productos) {
        $_section .= get_product($_productos, $_x);
    }
    $_section .= '</div>';
    $i++;
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