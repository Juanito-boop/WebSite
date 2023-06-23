<?php

namespace modulos\tarjetas;

class generadorTarjetas
{
    private mixed $productos;
    private mixed $secciones;

    public function __construct($dataGetProductos, $dataGetSecciones)
    {
        $this->productos = $dataGetProductos;
        $this->secciones = $dataGetSecciones;
    }

    private function getButton($isPromotion, $unique): string
    {
        $class = $isPromotion ? 'promotion-btn' : 'product-btn';
        $text = $isPromotion ? 'PROMOCIÓN' : 'INFORMACIÓN';
        $image = "<img src=../../img/magnifying-glass-plus-solid.svg Style='width: 15px;' alt=''>";
        return "<a href=./modulos/detalles/info.php?id=$unique class=$class>$image&nbsp;$text</a>";
    }

    private function renderProductCard($product): string
    {
        $categoria = $product['id_categoria'];
        $nombreVino = $product['nombre'];
        $precioVino = $product['precio'];
        $promocion = $product['promocion'];
        $unique = $product['id_unica'];
        $url = $product['url_imagen'];
        $cepa = $product['variedades']['variedad'];
        $button = $this->getButton($promocion, $unique);

        return "<div class='product'>
                    <div class='product_description'>
                        <img src='$url' alt='$nombreVino-$cepa' class='product_img'>
                        <h2 class='product_title bold'>$nombreVino</h2>
                        <h2 class='product_description bold'>$cepa</h2>
                        <h2 class='product_price bold'>$ $precioVino COP</h2>
                        $button
                    </div>
                </div>";
    }

    private function renderSection($section): string
    {
        $sectionName = $section['nombre'];
        $sectionHtml = "<h2 class='main-title'><strong>$sectionName</strong></h2>";
        $sectionHtml .= "<div class='container-products' id='container{$section['id_unica']}'>";

        foreach ($this->productos as $product) {
            if ($product['id_categoria'] == $section['id_unica']) {
                $sectionHtml .= $this->renderProductCard($product);
            }
        }

        $sectionHtml .= '</div>';

        return $sectionHtml;
    }

    public function showProductCards($seccionID): void
    {
        foreach ($this->secciones as $section) {
            if ($section['id_unica'] == $seccionID) {
                echo $this->renderSection($section);
                break;
            }
        }
    }

    public function showProductCardsWithPagination(): void
    {
        foreach ($this->secciones as $section) {
            echo "<div>";
            $this->showProductCards($section['id_unica']);
            echo "<div class='pagination'>";
            echo "<button id='prev-btn{$section['id_unica']}'>🔙</button>";
            echo "<button id='next-btn{$section['id_unica']}'>🔜</button>";
            echo "</div>";
            echo "</div>";
        }
    }
}