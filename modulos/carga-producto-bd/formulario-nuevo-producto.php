<?php
require '../../api/GET/supabaseGetVariedades.php';
require '../../api/GET/supabaseGetPaises.php';
require '../filtro/filtro.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../../css/formularioSubida.css">
</head>

<body>
    <form action="logica.php" id="formularioProducto" enctype="multipart/form-data" method="POST">
        <div class="contenedor-principal">
            <div class="contenedor-imagen">
                <img id="imagePreview" src="#" alt="Vista previa de la imagen">
            </div class="informacion">
                <div class="contenedor-informacion">
                    <label>
                        <span>Carga la imagen del vino:</span>
                        <input type="file" name="imagenes" id="imageInput" accept="image/*">
                    </label>
                    <label>
                        <span>Nombre Vino:</span>
                        <input type="text" class="informacion" name="nombre_vino">
                    </label>
                    <label>
                        <span>Cepa:</span>
                        <select class="informacion" id="variedades" name="variedad">
                            <?php generarOpcionesVariedad(); ?>
                        </select>
                    </label>
                    <label>
                        <span>Tipo de vino:</span>
                        <select name="tipos" id="tipos">
                            <?php tipos(); ?>
                        </select>
                    </label>
                    <label>
                        <span>Año de Añada:</span>
                        <input type="number" class="informacion" name="annada">
                    </label>
                    <label>
                        <span>Bodega Vino:</span>
                        <input type="text" class="informacion" name="bodega_vino">
                    </label>
                    <label>
                        <span>Pais:</span>
                        <select class="informacion" id="paises" name="pais">
                            <?php generarOpcionesPaises(); ?>
                        </select>
                    </label>
                    <label>
                        <span>Region:</span>
                        <input type="text" class="informacion" name="region">
                    </label>
                    <label>
                        <span>Precio:</span>
                        <input type="text" class="informacion" name="precio">
                    </label>
                    <label>
                        <span>Nivel Alcohol:</span>
                        <input type="number" class="informacion" name="nivel_alcohol" step="0.1">
                    </label>
                </div>
                <div class="contenedor-informacion">
                    <label>
                        <span>Tipo de Barrica:</span>
                        <input type="text" class="informacion" name="tipo_barrica">
                    </label>
                    <label>
                        <span>Descripcion:</span>
                        <textarea class="informacion" name="descripcion"></textarea>
                    </label>
                    <label>
                        <span>Notas Cata:</span>
                        <textarea class="informacion" name="notas_cata"></textarea>
                    </label>
                    <label>
                        <span>Temperatura Consumo:</span>
                        <input type="text" class="informacion" name="temperatura_consumo">
                    </label>
                    <label>
                        <span>Maridaje:</span>
                        <textarea class="informacion" name="maridaje"></textarea>
                    </label>
                    <label>
                        <span>Categoria:</span>
                        <select class="informacion" name="id_categoria">
                            <?php categorias(); ?>
                        </select>
                    </label>
                    <label>
                        <span>Stock Producto:</span>
                        <input type="number" class="informacion" name="stock">
                    </label>
                    <label>
                        <span>Promoción:</span>
                        <input type="checkbox" name="promocion">
                    </label>
                    <label>
                        <span>Activo:</span>
                        <input type="checkbox" name="activo">
                    </label>
                    <button type="submit" id="submitBtn">Cargar Producto</button>
                </div>
            </div>
        </div>
    </form>
    <script src="../../js/renderizadoImagen.js"></script>
    <script type="module" src="../../js/subidaImagen.js"></script>
</body>

</html>