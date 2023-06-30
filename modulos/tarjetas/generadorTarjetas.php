<?php

namespace modulos\tarjetas;

class generadorTarjetas
{
    private array $productos;
    private array $secciones;

    public function __construct(array $dataGetProductos, array $dataGetSecciones)
    {
        $this->productos = $dataGetProductos;
        $this->secciones = $dataGetSecciones;
    }

    private function getButton(bool $isPromotion, int $unique): string
    {
        $class = $isPromotion ? 'promotion-btn' : 'product-btn';
        $text = $isPromotion ? 'PROMOCIÓN' : 'INFORMACIÓN';
        $image = '<i class="fa-solid fa-magnifying-glass-plus"></i>';
        return "<a href=./modulos/detalles/info.php?id=$unique class=$class>$image&nbsp;$text</a>";
    }

    private function renderProductCard(array $product): string
    {
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

    private function renderSection(array $section): string
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

    public function showProductCards(int $seccionID): void
    {
        foreach ($this->secciones as $section) {
            if ($section['id_unica'] == $seccionID) {
                echo $this->renderSection($section);
                break;
            }
        }
    }

    public function renderPaginationButtons(int $sectionId): void
    {
        echo "<div class='pagination'>";
        echo "<button id='prev-btn$sectionId'><i class='fa-solid fa-arrow-left'></i></button>";
        echo "<button id='next-btn$sectionId'><i class='fa-solid fa-arrow-right'></i></button>";
        echo "</div>";
    }

    public function showProductCardsWithPagination(): void
    {
        foreach ($this->secciones as $section) {
            echo "<div>";
            $this->showProductCards($section['id_unica']);
            $this->renderPaginationButtons($section['id_unica']);
            echo "</div>";
        }
    }
}