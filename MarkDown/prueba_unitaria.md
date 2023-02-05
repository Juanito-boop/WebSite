<?php
    class PruebaUnitarias{
        public function testSeccion(){
            $resultado_secciones = [
                'id_unica' => 1,
                'nombre' => 'Sección 1'
            ];

            $resultado_productos = [
                'nuevo_precio' => 0, 
                'promocion' => false, 
                'mostrar' => true, 
                'imagen' => 'imagen.jpg', 
                'nombre' => 'Producto 1', 
                'sepa' => 'Separador', 
                'precio' => 1000.00, 

            ];

            $this->assertEquals($resultado_secciones['id_unica'] , 1); //Comprobamos que el id de la sección sea igual a 1.

            $this->assertFalse($resultado_productos['promocion']); //Comprobamos que la promoción sea falsa.

            $this->assertTrue($resultado_productos['mostrar']); //Comprobamos que el producto se muestre.

            $this->assertEquals($resultado_secciones['nombre'] , "Sección 1"); //Comprobamos que el nombre de la sección sea igual a "Sección 1".

        }  

    }
