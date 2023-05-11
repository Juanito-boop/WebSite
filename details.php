<?php
include_once("./details.php");
include_once("modulos/filtro/filtro.php");
include_once("modulos/consultas-preparadas/consultas-preparadas.php");
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/png" href="./img/image-removebg-preview.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap">
    <title>Vinos De La Villa</title>
    <!-- Estilos -->
    <link rel="stylesheet" href="css/aside.css">
    <link rel="stylesheet" href="css/Global.css">
    <link rel="stylesheet" href="css/Hamburguer.css">
    <link rel="stylesheet" href="css/Header.css">
    <link rel="stylesheet" href="css/Products.css">
    <link rel="stylesheet" href="css/Slider.css">
    <script src="https://kit.fontawesome.com/b33142c330.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="main-header">
        <form id="myForm" method="POST">
            <div class="main-header_container">
                <input type="search" id="query" name="query" class="main-header_input"
                    placeholder="What product are you looking for?" list="Lista">
                <datalist id="Lista">
                    <?php
                    generarLista();
                    ?>
                </datalist>
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </form>
    </header>
    <div class="contenedor_principal">
        <div class="container">
            <div>
                <img src="img/vinos/<?php $arreglo_productos["id_unica"] ?>.png" alt="">
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/css.js"></script>
    <script src="modulos/buscador/buscador.js"></script>
</body>