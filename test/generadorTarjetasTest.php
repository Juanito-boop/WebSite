<?php

namespace test\tarjetas;

use PHPUnit\Framework\TestCase;
use modulos\tarjetas\generadorTarjetas;

spl_autoload_register(function ($class) {
    if (file_exists(filename: str_replace(search: '\\', replace: '/', subject: $class) . '.php')) {
        require_once str_replace(search: '\\', replace: '/', subject: $class) . '.php';
    }
});

class generadorTarjetasTest extends TestCase
{
    public function testShowProductCards()
    {
        //json decode
        $jsonProductsString = file_get_contents('json/productos.json');
        $jsonSectionsString = file_get_contents('json/secciones.json');

        // Datos de prueba
        $dataGetProductos = json_decode($jsonProductsString, true);

        $dataGetSecciones = json_decode($jsonSectionsString, true);

        // Instanciar el objeto GeneradorTarjetas
        $generadorTarjetas = new generadorTarjetas($dataGetProductos, $dataGetSecciones);

        // Llamar al método showProductCards con el ID de sección deseado
        $seccionID = 1;
        $generadorTarjetas->showProductCards($seccionID);

        $arrayPrueba = array (
            'id' => 1, 'nombre' => 'Petirrojo', 'anada' => 2019, 'bodega' => 'Bodega Requingua, Chile', 'region' => 'Valle Central', 'precio' => 87.422, 'stock' => 40, 'tipo' => 'Tinto', 'nivel_alcohol' => 13.0, 'tipo_barrica' => 'El vino Petirrojo se añeja en barricas de roble francés y americano durante un periodo de 8 meses.', 'descripcion' => 'Un vino con cuerpo y personalidad única. Sus notas frutales y especiadas te transportarán a un bosque encantado, mientras que su elegante estructura te cautivará en cada sorbo.', 'notas_cata' => 'En nariz, este vino chileno ofrece una mezcla de frutas rojas, especias y notas florales. En boca, se destaca por su buena acidez y cuerpo medio, con sabores de cerezas, ciruelas y un toque de vainilla. El final es largo y persistente, con un ligero toque de taninos.', 'temperatura_consumo' => '16-18°C', 'activo' => true, 'id_unica' => 245726, 'url_imagen' => 'https://npuxpuelimayqrsmzqur.supabase.co/storage/v1/object/public/images/245726.png', 'promocion' => false, 'busqueda' => 4, 'maridaje' => 'Va muy bien con platos de pasta con salsa de tomate, carnes asadas y quesos suaves.', 'pais' => 3, 'id_categoria' => 1, 'variedad' => 5, 'paises' => array ('pais' => 'Chile',), 'secciones' => array ('nombre' => 'NUESTROS VINOS MAS VENDIDOS',), 'variedades' => array ('variedad' => 'Merlot',)
        );

        // Comprobaciones/assertions
        //
         $this->expectOutputString($arrayPrueba);
        // $this->assertEquals('Valor esperado', $generadorTarjetas->getSomeValue());

    }
}
