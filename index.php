<?php
require_once 'modulos/tarjetas/tarjetas.php';
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
    <link rel="stylesheet" href="css/Global.css">
    <link rel="stylesheet" href="css/Hamburguer.css">
    <link rel="stylesheet" href="css/Header.css">
    <link rel="stylesheet" href="css/Products.css">
    <link rel="stylesheet" href="css/Slider.css">

</head>

<body>
    <header class="main-header">
        <div class="container container--flex">
            <div class="main-header__container">
                <a href="modulos/inicio-sesion/login.html">
                    <img src="img/image-removebg-preview.png" alt="" class="logo">
                </a>
                <div class="centrado1">
                    <h1 class="main-header__title">LOS VINOS</h1>
                    <h2 class="main-header__subtitle"><i>Tienda Gourmet</i></h2>
                    <h3 class="main-header__subsubtitle">Carrera 9 11 47 Segundo piso de La Galleta</h3>
                    <p class="main-header__txt">CONTACTANOS (+57) 3219085857 <em class="fas fa-phone"></em></p>
                </div>
                <div class="icono-menu">
                    <img src="img/bars-solid.svg" id="icono-menu">
                </div>
                <div class="cont-menu opacity" id="menu">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">Sepas</a></li>
                    </ul>
                </div>
                <!-- Add cart button here -->
            </div>
        </div>
        <form id="formulario" method="POST" action="modulos/consultas-preparadas/consultas-preparadas.php">
            <div class="main-header__container">
                <input type="search" id="search" class="main-header__input"
                    placeholder="What product are you looking for?">
                <em class="fas fa-search" id="lupa"></em>
            </div>
        </form>
    </header>
    <div class="main" style="padding-bottom: 0px;">
        <!-- empiezan las tarjetas -->
        <div class="container">
            <!-- Este código es una estructura de una plantilla HTML que utiliza PHP para generar contenido dinámico. En este caso, se genera un contenedor con clase "container" que contiene tres repeticiones de un bloque div. Dentro de cada bloque, se llama a una función "tarjetas" con un argumento $i que indica el número de la iteración actual. Además, cada bloque contiene una subsección "pagination" con dos botones que tienen ids únicos en función de la $i. La función "range" se utiliza para generar el rango de números del 1 al 3 (ambos inclusive) y el bucle "foreach" se ejecuta tres veces, una por cada número en el rango. -->
            <?php
            foreach (range(1, 3) as $i) { ?>
                <div>
                    <?php
                    tarjetas($i);
                    ?>
                    <div class="pagination">
                        <button id="prev-btn<?php echo $i; ?>">🔙</button>
                        <button id="next-btn<?php echo $i; ?>">🔜</button>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="testimonials">
            <div class="container_testimonials">
                <h2 class="section_title">DESCUBRE UN POCO DE NOSOTROS</h2>
                <h3 class="testimonial_title">SOMOS VINOS DE LA VILLA</h3>

                <p class="testimonial_txt">Estamos ubicados en Villa De Leyva boyaca Carrera 9 11 47 Segundo piso de La
                    Galleta,
                    Villa de Leyva, Boyaca, Colombia</p>

                <p class="testimonial_txt">Lugar para los amantes del vino. Vino por copa desde COP$8000 Botellas desde
                    COP$27.900
                    Amplio surtido en vinos de: Colombia, España, Italia, Francia, Chile, Argentina y California para
                    acompañar:
                    Tapas, Panini, tablas de quesos y jamones. Buena música. Ambiente agradable.</p>

                <p class="testimonial_txt">Poseemos diferentes servicios como: Bar de vinos, Bar, Española, Pub. También
                    podemos
                    ofrecer servicio de restaurante como: Cenas, Abierto hasta tarde (revisar horario según
                    corresponda),
                    Bebidas</p>

                <p class="testimonial_txt">OTRAS CARACTERÍSTICAS: Comodos Asientos, Brindamos el fino alcohol, Wi-Fi
                    gratis,
                    Acepta tarjetas de crédito, Servicio de mesa, Reservas, Acceso para silla de ruedas, Vino y cerveza
                </p>

                <p>HORARIOS DE ATENCION :</p>
                <ul>
                    dom 12:00 p. m. - 10:00 p. m.<br>
                    lun-mar-mié-jue 3:00 p. m. - 10:00 p. m.<br>
                    vie-sáb 12:00 p. m. - 12:00 a. m.<br>
                </ul>

            </div>

            <div class="container-editor">
                <div class="editor_item">
                    <img src="img/pexels-payam-masouri-731348.jpg" alt="" class="editor_img">
                    <p class="editor_circle">SOPORTE </p>
                </div>
                <div class="editor_item">
                    <img src="img/pexels-grape-things-2647933.jpg" alt="" class="editor_img">
                    <p class="editor_circle">SERVICIO AL CLIENTE </p>
                </div>
            </div>

            <div class="container-tips">
                <div class="tip">
                    <em class="far fa-hand-paper"></em>
                    <h2 class="tip_title">DUEÑO</h2>
                    <p class="tip_txt">DIEGO Y COMPAÑIA S.A.S</p>
                    <p>NIT 890309454-8</p>
                    <p>KRA 9 # 11-47 P.2</p>
                    <a href="#" class="btn_shop">CONTACTO</a>
                </div>
                <div class="tip">
                    <em class="fas fa-rocket"></em>
                    <h2 class="tip_title">Gerente General</h2>
                    <p class="tip_txt">NUBIA VELASCO</p>
                    <p>KRA 9 # 11-47 P.2</p>
                    <p>Telefono: 3219085857</p>
                    <p>Correo Electronico: ventas@vinosdelavilla.com</p>
                    <a href="#" class="btn_shop">CONTACTO</a>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <div class="footer_section">
                <h2 class="footer_title">UBICACION :</h2>
                <p class="footer_txt"> Carrera 9 11 47 Segundo piso de La Galleta, a unos pasos de la plaza principal
                    de Villa de Leyva ,Boyaca, Colombia</p>
            </div>
            <div class="footer_section">
                <h2 class="footer_title">Links</h2>
                <p class="footer_txt"><a href="#">HOME</a></p>
            </div>
        </footer>
        <script src="js/hamburguer.js"></script>
        <script src="js/paginacion.js"></script>
    </div>
</body>