<?php
    include_once 'config/database.php';
    $sentencia_productos = $base_de_datos->query("SELECT nombre, sepa, descripcion, precio, id_categoria, producto, activo FROM productos where mostrar = true");
    $sentencia_secciones = $base_de_datos->query("SELECT nombre, activo, id_unica FROM secciones where activo = true");
    $resultado_productos = $sentencia_productos->fetchAll(PDO::FETCH_ASSOC);
    $resultado_secciones = $sentencia_secciones->fetchAll(PDO::FETCH_ASSOC);
?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/png" href="img/image-removebg-preview.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" />
    <link rel="stylesheet" href="css/Global.css" />
    <link rel="stylesheet" href="css/Hamburguer.css" />
    <link rel="stylesheet" href="css/Header.css" />
    <link rel="stylesheet" href="css/Products.css" />
    <link rel="stylesheet" href="css/Slider.css" />
    <title>Vinos De La Villa</title>
</head>

<header class="main-header">
    <div class="container container--flex">
        <br>
        <div class="main-header__container">
            <img src="img/image-removebg-preview.png" alt="" class="logo">
            <div class="centrado1">
                <h1 class="main-header__title">LOS VINOS</h1>
                <h2 class="main-header__subtitle"><i>Tienda Gourmet</i></h2>
                <strong>
                    <h3 class="main-header-subsubtitle">Carrera 9 11 47 Segundo piso de La Galleta</h3>
                </strong>
                <br>
                <div class="main-header__container">
                    <p class="main-header__txt">CONTACTANOS (+57) 3219085857 <em class="fas fa-phone"></em></p>
                </div>
            </div>
            <div class="icono-menu">
                <img src="img/bars-solid.svg" id="icono-menu">
            </div>
            <div class="cont-menu active" id="menu">
                <ul>
                    <a href="index.html">
                        <li> Home </li>
                    </a>
                    <a href="">
                        <li> Sepas </li>
                    </a>
                </ul>
            </div>
        </div>
        <br>
    </div>
    <div class="main-header__container">
        <input type="search" class="main-header__input" placeholder="Que Producto Deseas Buscar? ">
        <em class="fas fa-search" id="lupa
        "></em>
    </div>
</header>

<body>
    <div class="main" style="padding-bottom: 0px;">
        <div class="container">
            <?php foreach($resultado_secciones as $row) { ?>
                <?php
                    $seccion = $row['id_unica'];    
                ?>
                <?php if($seccion == 1){?>
                    <h2 class="main-title"><?php echo $row['nombre']?></h2>
                    <div class="container-products">
                        <?php foreach($resultado_productos as $row) { ?> <!-- foreach deposita los datos obtenidos en la variable row-->
                            <?php
                                $categoria = $row['id_categoria']; //declaro una variable y le digo que sea igual a la columna id_categoria
                                $unique = $row['producto']; //declaro una variable y le digo que sea igual a la columna producto
                                $imagen = "img/vinos/" . $unique . ".png"; //declaro una variable y le digo que sea igual a la ruta img/vinos. concateno la variable unique y agrego el formato de la imagen
                                if (!file_exists($imagen)) { //se declara una codicion que se interpreta de tal manera en que si no existe el archivo localizado con la variable imagen, se utilize una imagen diferente 
                                    $imagen = "img/logo.png";
                                }
                            ?>
                            <?php if($categoria == 1) { ?> <!-- se declara una condicion que indica que si la variable catergoria declarada previamente, es igual a 1, se generen las etiquetas html, junto con la ruta de la imagen, trayendo los datos almacenados en la base de datos -->
                                <div class="product">
                                    <div class="product__description">
                                    <img src="<?php echo $imagen; ?>" alt="" class="product__img">
                                        <h3 class="product__title"><?php echo $row['nombre']; ?></h3>
                                        <h3 class="product__title"><?php echo $row['sepa']; ?></h3>
                                        <span class="product__price"><?php echo number_format($row['precio'], 3, '.', ','); ?></span>
                                        <a href="" class="product-btn">
                                            <em class="fas fa-shopping-cart"> COMPRAR</em>
                                        </a> 
                                    </div>
                                </div>
                            <?php }?>
                        <?php }?> 
                    </div>
                <?php }?>
            <?php }?>
            <?php foreach($resultado_secciones as $row) { ?>
                <?php
                    $seccion = $row['id_unica'];    
                ?>
                <?php if($seccion == 2){?>
                    <h2 class="main-title"><?php echo $row['nombre']?></h2>
                    <div class="container-products">
                        <?php foreach($resultado_productos as $row) { ?>
                            <?php
                                $categoria = $row['id_categoria'];
                                $unique = $row['producto'];
                                $imagen = "img/vinos/" . $unique . ".pg";
                                if (!file_exists($imagen)) { 
                                    $imagen = "img/logo.png";
                                }
                            ?>
                            <?php if($categoria == 2) { ?>
                                <div class="product">
                                    <div class="product__description">
                                    <img src="<?php echo $imagen; ?>" alt="" class="product__img">
                                        <h3 class="product__title"><?php echo $row['nombre']; ?></h3>
                                        <h3 class="product__title"><?php echo $row['sepa']; ?></h3>
                                        <span class="product__price"><?php echo number_format($row['precio'], 3, '.', ','); ?></span>
                                        <a href="" class="product-btn">
                                            <em class="fas fa-shopping-cart"> COMPRAR</em>
                                        </a> 
                                    </div>
                                </div>
                            <?php }?>
                        <?php }?> 
                    </div>
                <?php }?>
            <?php }?>
            <?php foreach($resultado_secciones as $row) { ?>
                <?php
                    $seccion = $row['id_unica'];    
                ?>
                <?php if($seccion == 3){?>
                    <h2 class="main-title"><?php echo $row['nombre']?></h2>
                    <div class="container-products">
                        <?php foreach($resultado_productos as $row) { ?>
                            <?php
                                $categoria = $row['id_categoria'];
                                $unique = $row['producto'];
                                $imagen = "img/vinos/" . $unique . ".png";
                                if (!file_exists($imagen)) { 
                                    $imagen = "img/logo.png";
                                }
                            ?>
                            <?php if($categoria == 3) { ?>
                                <div class="product">
                                    <div class="product__description">
                                    <img src="<?php echo $imagen; ?>" alt="" class="product__img">
                                        <h3 class="product__title"><?php echo $row['nombre']; ?></h3>
                                        <h3 class="product__title"><?php echo $row['sepa']; ?></h3>
                                        <span class="product__price"><?php echo number_format($row['precio'], 3, '.', ','); ?></span>
                                        <a href="" class="product-btn">
                                            <em class="fas fa-shopping-cart"> COMPRAR</em>
                                        </a> 
                                    </div>
                                </div>
                            <?php }?>
                        <?php }?> 
                    </div>
                <?php }?>
            <?php }?>
        <div class="container-slider">
            <div class="slider" id="slider">
                <div class="slider__section">
                    <img src="img/pofvnj.jpg" alt="" class="slider__img" />
                    <div class="slider__content">
                        <h2 class="slider__title">Los mejores vinos</h2>
                        <p class="slider__txt">En invierno no hay mal abrigo con una copa de buen vino</p>
                        <a href="" class="slider__link">ADQUIERE TU BOTELLA ¿QUE ESPERAS?</a>
                    </div>
                </div>
                <div class="slider__section">
                    <img src="img/villix.jpg" alt="" class="slider__img" />
                    <div class="slider__content">
                        <h2 class="slider__title">UN POCO ACERCA DE NOSOTROS</h2>
                        <p class="slider__txt">Nos encontramos en villa de leyva, te esperamos para degustar una buena
                            copa
                        </p>
                        <a href="" class="slider__link">Villa de Leyva Boyaca </a>
                    </div>
                </div>
                <div class="slider__section">
                    <img src="img/vinos.jpg" alt="" class="slider__img" />
                    <div class="slider__content">
                        <h2 class="slider__title">Vinos de la más alta calidad</h2>
                        <p class="slider__txt">En nuestro repertorio podemos encontrar una gran cantidad y variedad de
                            vinos
                            tanto nacionales como internacionales
                            <br>
                            "Un día sin vino es un día sin sol"
                        </p>
                        <a href="" class="slider__link">ADQUIERE EL TUYO AHORA</a>
                    </div>
                </div>
                <div class="slider__section">
                    <img src="img/xdeerf.jpg" alt="" class="slider__img" />
                    <div class="slider__content">
                        <h2 class="slider__title">Con nosotros tendrá la mejor experiencia vinícola</h2>
                        <p class="slider__txt">El vino siembra poesía en los corazones</p>
                        <a href="" class="slider__link">ADQUIERE EL TUYO AHORA</a>
                    </div>
                </div>
            </div>
            <div class="slider__btn slider__btn--right" id="btn-right">&#62;</div>
            <div class="slider__btn slider__btn--left" id="btn-left">&#60;</div>
        </div>
        <div class="testimonials">
            <div class="container__testimonials">
                <h2 class="section__title">DESCUBRE UN POCO DE NOSOTROS</h2>
                <h3 class="testimonial__title">SOMOS VINOS DE LA VILLA</h3>
                <br>
                <p class="testimonial__txt">Estamos ubicados en Villa De Leyba boyaca
                    Carrera 9 11 47 Segundo piso de La Galleta, Villa de Leyva ,Boyaca, Colombia
                    <br>
                <p class="testimonial__txt"> lugar para los amantes del vino. Vino por copa desde COP$8000 Botellas
                    desde COP$27.900 Amplio surtido en vinos de:
                    Colombia, España, Italia, Francia, Chile, Argentina, California
                    para acompañar: Tapas, Panini, tablas de quesos y jamones. Buena musica. Ambiente agradable.</p>
                <br>
                <p class="testimonial__txt"> Poseemos deferentes servicios como :Bar de vinos, Bar, Española, Pub
                    tambien podemos ofrecer servicio de restarurante como :Cena, Abierto hasta tarde(revisar horario
                    segun corresponda ), Bebidas</p>
                <br>
                <p class="testimonial__txt"> OTRAS CARACTERÍSTICAS
                    Comodos Asientos, Brindaos el fino alcohol, Wi-Fi gratis, Acepta tarjetas de crédito, Servicio de
                    mesa, Reservas, Acceso para silla de ruedas, Vino y cerveza</p>
                HORARIOS DE ATENCION :
                <br>
                dom
                12:00 p. m. - 10:00 p. m.
                <br>
                lun
                3:00 p. m. - 10:00 p. m.
                <br>
                mar
                3:00 p. m. - 10:00 p. m.
                <br>
                mié
                3:00 p. m. - 10:00 p. m.
                <br>
                jue
                3:00 p. m. - 10:00 p. m.
                <br>
                vie
                12:00 p. m. - 12:00 a. m.
                <br>
                sáb
                12:00 p. m. - 12:00 a. m.
                </p>
            </div>
            <div class="container-editor">
                <div class="editor__item">
                    <img src="img/pexels-payam-masouri-731348.jpg" alt="" class="editor__img">
                    <p class="editor__circle">SOPORTE </p>
                </div>
                <div class="editor__item">
                    <img src="img/pexels-grape-things-2647933.jpg" alt="" class="editor__img">
                    <p class="editor__circle">SERVICIO AL CLINETE </p>
                </div>
            </div>
            <div class="container-tips">
                <div class="tip">
                    <em class="far fa-hand-paper"></em>
                    <h2 class="tip__title">DUEÑO</h2>
                    <p class="tip__txt">DIEGO Y COMPAÑIA S.A.S
                    <P>
                        NIT 890309454-8
                    </P>
                    <p>
                        KRA 9 # 11-47 P.2
                    </p>
                    <a href="" class="btn__shop">contacto </a>
                    </p>
                </div>
                <div class="tip">
                    <em class="fas fa-rocket"></em>
                    <h2 class="tip__title">Gerente General</h2>
                    <p class="tip__txt">
                    <p>
                        NUBIA VELASCO
                    </p>
                    <P>
                        KRA 9 # 11-47 P.2
                    </P>
                    <P>
                        Telefono : 3219085857
                    </P>
                    <P>
                        Correo Electronico: ventas@vinosdelavilla.com
                    </P>
                    </p>
                    <a href="" class="btn__shop">contacto </a>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <div class="footer__section">
                <h2 class="footer__title">UBICACION :</h2>
                <p class="footer__txt"> Carrera 9 11 47 Segundo piso de La Galleta, a unos pasos de la plaza principal
                    de Villa de Leyva ,Boyaca, Colombia</p>
            </div>
            <div class="footer__section">
                <h2 class="footer__title">Links</h2>
                <p class="footer__txt"><a href="">HOME</a></p>
            </div>
        </footer>
    </div>
    <script src="js/slider.js"></script>
    <script src="js/hamburguer.js"></script>
</body>