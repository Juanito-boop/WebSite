<?php

namespace modulos\tarjetas;

class generadorTarjetas
{
    private $productos;
    private $secciones;

    public function __construct($dataGetProductos, $dataGetSecciones)
    {
        $this->productos = $dataGetProductos;
        $this->secciones = $dataGetSecciones;
    }

    private function getButton($isPromotion, $unique): string
    {
        $class = $isPromotion ? 'promotion-btn' : 'product-btn';
        $text = $isPromotion ? 'PROMOCIÓN' : 'INFORMACIÓN';
        return "<a href=./modulos/detalles/info.php?id=$unique class=$class>
                    <img src=./img/magnifying-glass-plus-solid.svg Style='width: 15px;' alt=''>&nbsp;{$text}
                </a>";
    }

    private function getProduct($producto, $categoriaSeleccionada):  ? string
    {
        $categoria = $producto['id_categoria'];
        $nombreVino = $producto['nombre'];
        $precioVino = $producto['precio'];
        $promocion = $producto['promocion'];
        $unique = $producto['id_unica'];
        $url = $producto['url_imagen'];
        $cepa = $producto['variedades']['variedad'];

        $button = $this->getButton($promocion, $unique);

        if ($categoria == $categoriaSeleccionada) {
            return "<div class=product>
                        <div class=product_description>
                            <img src=$url alt=$nombreVino-$cepa class=product_img>
                            <h2 class=product_title bold>$nombreVino</h2>
                            <h2 class=product_description bold>$cepa</h2>
                            <h2 class=product_price bold> $ $precioVino COP </h2>
                            $button
                        </div>
                    </div>";
        }

        return null;
    }

    private function getSection($seccion, $seccionSeleccionada) : string
    {
        $section = "<h2 class=main-title><strong>{$seccion['nombre']}</strong></h2>";
        $section .= '<div class=container-products id=container' . $seccionSeleccionada . '>';
        foreach ($this->productos as $producto) {
            $productHtml = $this->getProduct($producto, $seccionSeleccionada);
            if ($productHtml !== null) {
                $section .= $productHtml;
            }
        }
        $section .= '</div>';

        return $section;
    }

    private function getAllSections($seccionID): string
    {
        $sectionsHtml = "";
        foreach ($this->secciones as $seccion) {
            if ($seccion['id_unica'] == $seccionID) {
                $sectionHtml = $this->getSection($seccion, $seccionID);
                $sectionsHtml .= $sectionHtml;
            }
        }
        return $sectionsHtml;
    }

    public function showProductCards($seccionID): void
    {
        $sectionsHtml = $this->getAllSections($seccionID);
        echo $sectionsHtml;
    }

    public function showProductCardsWithPagination(): void
    {
        $totalSecciones = count($this->secciones);
        for ($i = 1; $i <= $totalSecciones; $i++) {
            echo '<div>';
            $this->showProductCards($i);
            echo '<div class="pagination">';
            echo '<button id="prev-btn' . $i . '">🔙</button>';
            echo '<button id="next-btn' . $i . '">🔜</button>';
            echo '</div>';
            echo '</div>';
        }
    }
}
