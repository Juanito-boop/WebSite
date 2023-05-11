<?php

require './modulos/consultas-preparadas/consultas-preparadas.php';

class TarjetasProductos
{
    private $resultado_productos;
    private $resultado_secciones;

    public function __construct($resultado_productos, $resultado_secciones)
    {
        $this->resultado_productos = $resultado_productos;
        $this->resultado_secciones = $resultado_secciones;
    }

    public function get_image($unique_id)
    {
        $image_path = 'img/vinos/' . $unique_id . '.png';
        $image_exists = file_exists($image_path) ? $image_path : "img/logo.png";
        return $image_exists;
    }

    public function get_button($isPromotion)
    {
        $class = $isPromotion ? 'promotion-btn' : 'product-btn';
        $text = $isPromotion ? 'PROMOCION' : 'COMPRAR';
        return '<a href="" class="' . $class . '"><em class="fas fa-shopping-cart">' . $text . '</em></a>';
    }

    public function get_product($resultado_productos, $x)
    {
        $categoria = $resultado_productos["categoria_vino"];
        $nombre = $resultado_productos["nombre_vino"];
        $precio = $resultado_productos["precio_vino"];
        $promocion = $resultado_productos["promocion"];
        $unique = $resultado_productos["imagen_vino"];
        $uva = $resultado_productos["uva_vino"];

        $taza_cambio = 4568.38;

        $button = $this->get_button($promocion);
        $imagen = $this->get_image($unique);
        $precio_cop = $precio * $taza_cambio;

        if ($categoria == $x) {
            return '
            <div class="product">
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

    public function get_section($resultado_secciones, $x, $resultado_productos)
    {
        static $i = 1;
        $section = '<h2 class="main-title"><strong>' . $resultado_secciones['nombre'] . '</strong></h2>';
        $section .= '<div class="container-products" id="container' . $i . '">';
        foreach ($resultado_productos as $productos) {
            $section .= $this->get_product($productos, $x);
        }
        $section .= '</div>';
        $i++;
        return $section;
    }

    public function get_all_sections($x)
    {
        $sections = "";
        foreach ($this->resultado_secciones as $seccion_productos) {
            $id_unica = $seccion_productos["id_unica"];
            if ($id_unica == $x || $x == 4) {
                $sections .= $this->get_section($seccion_productos, $id_unica, $this->resultado_productos);
            }
        }
        return $sections;
    }

    public function tarjetas($x)
    {
        $sections = $this->get_all_sections($x);
        echo $sections;
    }

    public function tarjetasFin()
    {
        $total_secciones = count($this->resultado_secciones);
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
}